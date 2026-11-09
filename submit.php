<?php
declare(strict_types=1);
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

function back(string $type, string $msg): never
{
    $_SESSION[$type] = $msg;
    header('Location: index.php#tour');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php#tour');
    exit;
}


// CSRF
if (!csrf_valid($_POST['csrf_token'] ?? '')) {
    back('error', 'Your session expired. Please try again.');
}

// Simple rate limit: 1 submission per 30 seconds per session
if (isset($_SESSION['last_submit']) && time() - $_SESSION['last_submit'] < 30) {
    back('error', 'Please wait a moment before submitting again.');
}

$parentName    = trim($_POST['parent_name'] ?? '');
$childAge      = trim($_POST['child_age'] ?? '');
$email         = trim($_POST['email'] ?? '');
$phone         = trim($_POST['phone'] ?? '');
$preferredDate = trim($_POST['preferred_date'] ?? '');
$preferredTime = trim($_POST['preferred_time'] ?? '');
$message       = trim($_POST['message'] ?? '');

$errors = [];
if ($parentName === '' || mb_strlen($parentName) > 150) $errors[] = 'Please enter your name.';
if ($childAge === '' || mb_strlen($childAge) > 50)      $errors[] = "Please enter your child's age.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 255) $errors[] = 'Please enter a valid email address.';
if (mb_strlen($phone) > 50)                             $errors[] = 'Please enter a valid phone number.';
if ($message === '' || mb_strlen($message) > 3000)      $errors[] = 'Please enter a message (max 3000 characters).';
if (!in_array($preferredTime, ['', 'Morning', 'Midday', 'Afternoon'], true)) $errors[] = 'Please select a valid time.';

if ($preferredDate !== '') {
    $dt = DateTime::createFromFormat('Y-m-d', $preferredDate);
    if (!$dt || $dt->format('Y-m-d') !== $preferredDate) {
        $errors[] = 'Please select a valid tour date.';
    }
}

if ($errors) {
    back('error', implode(' ', $errors));
}

// Save to database
try {
    $stmt = $pdo->prepare(
        'INSERT INTO inquiries (parent_name, child_age, email, phone, preferred_date, preferred_time, message, ip_address)
         VALUES (:parent_name, :child_age, :email, :phone, :preferred_date, :preferred_time, :message, :ip)'
    );
    $stmt->execute([
        ':parent_name'    => $parentName,
        ':child_age'      => $childAge,
        ':email'          => $email,
        ':phone'          => $phone !== '' ? $phone : null,
        ':preferred_date' => $preferredDate !== '' ? $preferredDate : null,
        ':preferred_time' => $preferredTime !== '' ? $preferredTime : null,
        ':message'        => $message,
        ':ip'             => substr($_SERVER['REMOTE_ADDR'] ?? '', 0, 45),
    ]);
    $inquiryId = (int)$pdo->lastInsertId();
} catch (Throwable $ex) {
    error_log('Inquiry save failed: ' . $ex->getMessage());
    back('error', 'We were unable to submit your request right now. Please try again or contact us directly.');
}

$_SESSION['last_submit'] = time();
$_SESSION['csrf_token']  = bin2hex(random_bytes(32));
back('success', 'Thank you! Your request has been received. We will contact you within one business day.');
