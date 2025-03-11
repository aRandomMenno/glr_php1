<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    if (empty($_POST['name'])) {
        $errors[] = "Naam is verplicht";
    }

    if (empty($_POST['student_number'])) {
        $errors[] = "Studentnummer is verplicht";
    } elseif (!preg_match('/^[0-9]{6}$/', $_POST['student_number'])) {
        $errors[] = "Studentnummer moet uit precies 6 cijfers bestaan";
    }

    if (empty($_POST['class'])) {
        $errors[] = "Klas is verplicht";
    } elseif (!preg_match('/^D[1-3][A-F][1-2]$/', $_POST['class'])) {
        $errors[] = "Klas moet het format D1-3A-F1-2 hebben";
    }

    $required_fields = ['class_1', 'class_2', 'class_3', 'class_4'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = "Alle vaknamen zijn verplicht";
            break;
        }
    }

    $grade_fields = ['grade_1', 'grade_2', 'grade_3', 'grade_4'];
    foreach ($grade_fields as $field) {
        if (!isset($_POST[$field])) {
            $errors[] = "Alle cijfers zijn verplicht";
            break;
        } elseif (!is_numeric($_POST[$field])) {
            $errors[] = "Cijfers moeten numeriek zijn";
            break;
        } elseif ($_POST[$field] < 1.0 || $_POST[$field] > 10.0) {
            $errors[] = "Cijfers moeten tussen 1.0 en 10.0 liggen";
            break;
        }
    }

    $class_values = array_filter([
        $_POST['class_1'] ?? '',
        $_POST['class_2'] ?? '',
        $_POST['class_3'] ?? '',
        $_POST['class_4'] ?? '',
    ]);

    if (count($class_values) !== count(array_unique($class_values))) {
        $errors[] = "Vaknamen moeten uniek zijn";
    }

    if (!empty($errors)) {
        $error_message = implode("; ", $errors);
        header('location: index.php?error=' . urlencode($error_message));
        exit;
    }

    $name = $_POST['name'];
    $student_number = $_POST['student_number'];
    $class = $_POST['class'];

    $classes_grades = [
        $_POST['class_1'] => $_POST['grade_1'],
        $_POST['class_2'] => $_POST['grade_2'],
        $_POST['class_3'] => $_POST['grade_3'],
        $_POST['class_4'] => $_POST['grade_4'],
    ];

    $total_grade = 0;
    $grade_count = 0;

    foreach ($classes_grades as $subject => $grade) {
        if (!empty($grade)) {
            $total_grade += $grade;
            $grade_count++;
        }
    }

    $average_grade = ($grade_count > 0) ? round($total_grade / $grade_count, 1) : 0;

    $data = [
        'timestamp' => date('Y-m-d H:i:s'),
        'name' => $name,
        'student_number' => $student_number,
        'class' => $class,
        'classes_grades' => $classes_grades,
        'average_grade' => $average_grade,
    ];

    $data_dir = __DIR__ . '/data';
    if (!file_exists($data_dir)) {
        mkdir($data_dir, 0755, true);
    }

    $data_file = $data_dir . '/student_records.txt';
    file_put_contents($data_file, json_encode($data) . PHP_EOL, FILE_APPEND);

    include_once "index_view.php";
} else {
    header('location: index.php');
    exit;
}
