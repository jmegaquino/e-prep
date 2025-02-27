<?php
include '../config.php';

function handleFileUpload($file, $targetDir) {
    $targetFile = $targetDir . basename($file['name']);
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        return $targetFile;
    } else {
        echo "Error uploading file: " . $file['name'] . "<br>";
        return null;
    }
}

function handleFolderUpload($zipFile, $extractDir) {
    mkdir($extractDir, 0777, true);
    $zip = new ZipArchive;
    if ($zip->open($zipFile) === TRUE) {
        $zip->extractTo($extractDir);
        $zip->close();
        return $extractDir;
    } else {
        echo "Error extracting ZIP file: $zipFile<br>";
        return null;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $lesson_id = intval($_POST['id']);
    $lessonTitle = mysqli_real_escape_string($link, strip_tags($_POST['lessonTitle']));
    $lessonDescription = mysqli_real_escape_string($link, strip_tags($_POST['lessonDescription']));

    // Update Lesson
    $sql = "UPDATE lessons SET title = ?, description = ? WHERE id = ?";
    $stmt = $link->prepare($sql);
    if (!$stmt) {
        die("SQL Prepare Error (Lesson Update): " . $link->error);
    }
    $stmt->bind_param("ssi", $lessonTitle, $lessonDescription, $lesson_id);
    if ($stmt->execute()) {
        echo "Lesson updated successfully.<br>";

    // Handle lesson content updates
    if (!empty($_POST['sectionTitle']) && !empty($_POST['sectionBody'])) {
        // Preserve existing content IDs for deletion logic
        $preserveContentIds = $_POST['existingContentIds'] ?? [];
        $placeholders = !empty($preserveContentIds) ? implode(',', array_fill(0, count($preserveContentIds), '?')) : '';

        // Delete unused lesson content
        if ($placeholders) {
            $deleteContentSql = "DELETE FROM lesson_content WHERE lesson_id = ? AND id NOT IN ($placeholders)";
            $deleteContentStmt = $link->prepare($deleteContentSql);
            if ($deleteContentStmt) {
                $deleteContentStmt->bind_param(str_repeat('i', count($preserveContentIds) + 1), $lesson_id, ...$preserveContentIds);
                if ($deleteContentStmt->execute()) {
                    // No output needed here, handled silently
                }
                $deleteContentStmt->close();
            }
        }

        // Insert or update lesson content
        foreach ($_POST['sectionTitle'] as $index => $sectionTitle) {
            $sectionBody = $_POST['sectionBody'][$index] ?? '';
            $contentId = $_POST['existingContentIds'][$index] ?? null;

            if (!empty($contentId)) {
                // Update existing section
                $updateContentSql = "UPDATE lesson_content SET section_title = ?, section_body = ? WHERE id = ?";
                $updateContentStmt = $link->prepare($updateContentSql);
                if ($updateContentStmt) {
                    $updateContentStmt->bind_param("ssi", $sectionTitle, $sectionBody, $contentId);
                    $updateContentStmt->execute();
                    $updateContentStmt->close();
                }
            } else {
                // Insert new section
                $insertContentSql = "INSERT INTO lesson_content (lesson_id, section_title, section_body) VALUES (?, ?, ?)";
                $insertContentStmt = $link->prepare($insertContentSql);
                if ($insertContentStmt) {
                    $insertContentStmt->bind_param("iss", $lesson_id, $sectionTitle, $sectionBody);
                    $insertContentStmt->execute();
                    $insertContentStmt->close();
                }
            }
        }
    }


        // Handle virtual labs
        $preserveLabs = $_POST['existingLabIds'] ?? [];
        $placeholders = implode(',', array_fill(0, count($preserveLabs), '?'));

        // Delete unused virtual labs
        if ($placeholders) {
            $deleteLabsSql = "DELETE FROM virtual_labs WHERE lesson_id = ? AND id NOT IN ($placeholders)";
            $deleteLabsStmt = $link->prepare($deleteLabsSql);
            if (!$deleteLabsStmt) {
                die("SQL Prepare Error (Delete Labs): " . $link->error);
            }
            $params = array_merge([$lesson_id], $preserveLabs);
            $deleteLabsStmt->bind_param(str_repeat('i', count($params)), ...$params);
            $deleteLabsStmt->execute();
            echo "Deleted unused virtual labs.<br>";
            $deleteLabsStmt->close();
        }

        // Insert or update virtual labs
        if (isset($_POST['virtualLabType'])) {
            foreach ($_POST['virtualLabType'] as $index => $virtualLabType) {
                $virtualLabData = null;
                $launchFile = $_POST['editLaunchFile'][$index] ?? null;

                if ($virtualLabType === 'embedLink' && isset($_POST['editVirtualLabLink'][$index])) {
                    $virtualLabData = mysqli_real_escape_string($link, $_POST['editVirtualLabLink'][$index]);
                } elseif ($virtualLabType === 'uploadFile' && isset($_FILES['editVirtualLabFile']['tmp_name'][$index])) {
                    $virtualLabData = handleFileUpload($_FILES['editVirtualLabFile']['tmp_name'][$index], "uploads/labs/");
                } elseif ($virtualLabType === 'uploadFolder' && isset($_FILES['editVirtualLabFolder']['tmp_name'][$index])) {
                    $virtualLabData = handleFolderUpload($_FILES['editVirtualLabFolder']['tmp_name'][$index], "uploads/labs/" . pathinfo($_FILES['editVirtualLabFolder']['name'][$index], PATHINFO_FILENAME));
                }

                $labId = $_POST['existingLabIds'][$index] ?? null;

                if ($virtualLabData || $labId) {
                    if ($labId) {
                        // Update existing virtual lab
                        $updateLabSql = "UPDATE virtual_labs SET lab_type = ?, lab_data = ?, launch_file = ? WHERE id = ?";
                        $updateLabStmt = $link->prepare($updateLabSql);
                        if (!$updateLabStmt) {
                            echo "SQL Prepare Error (Update Labs): " . $link->error . "<br>";
                            continue;
                        }
                        $updateLabStmt->bind_param("sssi", $virtualLabType, $virtualLabData, $launchFile, $labId);
                        if ($updateLabStmt->execute()) {
                            echo "Updated Virtual Lab ID = $labId<br>";
                        } else {
                            echo "Error updating virtual lab: " . $link->error . "<br>";
                        }
                        $updateLabStmt->close();
                    } else {
                        // Insert new virtual lab
                        $insertLabSql = "INSERT INTO virtual_labs (lesson_id, lab_type, lab_data, launch_file) VALUES (?, ?, ?, ?)";
                        $insertLabStmt = $link->prepare($insertLabSql);
                        if (!$insertLabStmt) {
                            echo "SQL Prepare Error (Insert Labs): " . $link->error . "<br>";
                            continue;
                        }
                        $insertLabStmt->bind_param("isss", $lesson_id, $virtualLabType, $virtualLabData, $launchFile);
                        if ($insertLabStmt->execute()) {
                            echo "Inserted New Virtual Lab: Type = $virtualLabType<br>";
                        } else {
                            echo "Error inserting virtual lab: " . $link->error . "<br>";
                        }
                        $insertLabStmt->close();
                    }
                } else {
                    echo "No valid data for virtual lab #$index.<br>";
                }
            }
        }
    } else {
        echo "Error updating lesson: " . $stmt->error . "<br>";
    }
    $stmt->close();
}

mysqli_close($link);
?>
