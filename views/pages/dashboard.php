<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: /views/pages/login.php');
    exit();
}

include_once __DIR__ . '/../../models/Meeting.php';
include_once __DIR__ . '/../../models/User.php';

$meetingModel = new Meeting();
$meetings = $meetingModel->getMeetingsForUser($_SESSION['user_id']);
$pendingInvitations = $meetingModel->getPendingInvitationsForUser($_SESSION['user_id']);

$userModel = new User();
$searchResults = [];

if (isset($_GET['search_term'])) {
    $searchTerm = $_GET['search_term'];
    $searchResults = $userModel->searchUsers($searchTerm);
}

include_once __DIR__ . '/../templates/header.php';
?>

<div class="container">
    <h2>Create New Meeting</h2>
    <form action="/controllers/MeetingController.php?action=create" method="post">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="start_time">Start Time:</label>
            <input type="datetime-local" id="start_time" name="start_time" required>
        </div>
        <div class="form-group">
            <label for="end_time">End Time:</label>
            <input type="datetime-local" id="end_time" name="end_time" required>
        </div>
        <button type="submit" class="btn">Create Meeting</button>
    </form>

    <hr>

    <h2>Invite Participants</h2>
    <form action="/views/pages/dashboard.php" method="get">
        <div class="form-group">
            <label for="search_term">Search Users:</label>
            <input type="text" id="search_term" name="search_term" placeholder="Search by name or email">
        </div>
        <button type="submit" class="btn">Search</button>
    </form>

    <?php if (!empty($searchResults)): ?>
        <h3>Search Results:</h3>
        <ul>
            <?php foreach ($searchResults as $user): ?>
                <li>
                    <?php echo htmlspecialchars($user['name']); ?> (<?php echo htmlspecialchars($user['email']); ?>) - ID: <?php echo htmlspecialchars($user['id']); ?>
                    <form action="/controllers/MeetingController.php?action=invite" method="post" style="display:inline;">
                        <input type="hidden" name="meeting_id" value=""><!-- To be filled dynamically after meeting creation -->
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                        <button type="submit">Invite</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php elseif (isset($_GET['search_term'])): ?>
        <p>No users found.</p>
    <?php endif; ?>

    <hr>

    <h2>Pending Invitations</h2>
    <?php if (!empty($pendingInvitations)): ?>
        <ul>
            <?php foreach ($pendingInvitations as $invitation): ?>
                <li>
                    <strong><?php echo htmlspecialchars($invitation['title']); ?></strong> from <?php echo htmlspecialchars($invitation['creator_name']); ?><br>
                    Description: <?php echo htmlspecialchars($invitation['description']); ?><br>
                    From: <?php echo htmlspecialchars($invitation['start_time']); ?> To: <?php echo htmlspecialchars($invitation['end_time']); ?><br>
                    <form action="/controllers/MeetingController.php?action=update_status" method="post" style="display:inline;">
                        <input type="hidden" name="meeting_id" value="<?php echo htmlspecialchars($invitation['id']); ?>">
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
                        <input type="hidden" name="status" value="accepted">
                        <button type="submit">Accept</button>
                    </form>
                    <form action="/controllers/MeetingController.php?action=update_status" method="post" style="display:inline;">
                        <input type="hidden" name="meeting_id" value="<?php echo htmlspecialchars($invitation['id']); ?>">
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
                        <input type="hidden" name="status" value="declined">
                        <button type="submit">Decline</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No pending invitations.</p>
    <?php endif; ?>

    <hr>

    <h2>Upcoming Meetings</h2>
    <?php if (!empty($meetings)): ?>
        <ul>
            <?php foreach ($meetings as $meeting): ?>
                <li>
                    <strong><?php echo htmlspecialchars($meeting['title']); ?></strong><br>
                    <?php echo htmlspecialchars($meeting['description']); ?><br>
                    From: <?php echo htmlspecialchars($meeting['start_time']); ?> To: <?php echo htmlspecialchars($meeting['end_time']); ?><br>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No upcoming meetings.</p>
    <?php endif; ?>
</div>

<?php include_once __DIR__ . '/../templates/footer.php'; ?>