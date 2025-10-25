You are a Gemini agent helping me with my college project.

## Project Specifications

- **Language**: PHP (simple, procedural approach within MVC)
- **Database**: MySQL (via XAMPP)
- **Style**: Minimalist CSS for a clean and functional interface.
- **Architecture**: MVC (Model-View-Controller)

---

## Core Features

- **User Management**:
  - User registration and login.
  - User profiles with basic information (name, email).
- **Calendar & Meetings**:
  - Visual calendar (monthly view as default).
  - Schedule new meetings with a title, description, date, and time.
  - View meeting details.
  - Add other registered users to meetings by searching their name or email.
  - Simple in-app notifications for meeting invitations.

---

## Database Schema

- **`users` table**:
  - `id` (INT, Primary Key, AUTO_INCREMENT)
  - `name` (VARCHAR)
  - `email` (VARCHAR, UNIQUE)
  - `password` (VARCHAR, hashed)
- **`meetings` table**:
  - `id` (INT, Primary Key, AUTO_INCREMENT)
  - `title` (VARCHAR)
  - `description` (TEXT)
  - `start_time` (DATETIME)
  - `end_time` (DATETIME)
  - `creator_id` (INT, Foreign Key to `users.id`)
- **`meeting_participants` table**:
  - `meeting_id` (INT, Foreign Key to `meetings.id`)
  - `user_id` (INT, Foreign Key to `users.id`)
  - `status` (ENUM('pending', 'accepted'), default 'pending')

---

## MVC Structure Breakdown

- **Models** (Database interaction logic):
  - `User.php`:
    - `createUser($name, $email, $password)`
    - `findUserByEmail($email)`
    - `findUserById($id)`
    - `searchUsers($searchTerm)`
  - `Meeting.php`:
    - `createMeeting($title, $description, $startTime, $endTime, $creatorId)`
    - `getMeetingsForUser($userId)`
    - `addParticipant($meetingId, $userId)`
    - `updateParticipantStatus($meetingId, $userId, $status)`

- **Views** (HTML templates with minimal PHP for displaying data):
  - `pages/login.php`: Login form.
  - `pages/register.php`: Registration form.
  - `pages/dashboard.php`: Main view with the calendar.
  - `templates/header.php`, `templates/footer.php`: Common layout elements.

- **Controllers** (Handle user input and orchestrate Models and Views):
  - `UserController.php`:
    - `handleRegister()`: Process registration form.
    - `handleLogin()`: Process login form and manage session.
    - `handleLogout()`: Terminate session.
  - `MeetingController.php`:
    - `showCalendar()`: Display the main dashboard with meetings.
    - `createMeeting()`: Handle the creation of a new meeting.
    - `inviteParticipant()`: Handle adding users to a meeting.

---

## Development Plan

This section outlines the development plan for the project.

### Phase 1: User Management

1.  **Database Setup:**
    -   [x] Configure database connection in `config/database.php`.
    -   [ ] Create `users` table in MySQL.
2.  **User Registration:**
    -   [ ] Create registration form in `views/pages/register.php`.
    -   [ ] Implement `handleRegister()` in `controllers/UserController.php` to process form data.
    -   [ ] Implement `createUser()` in `models/User.php` to insert new user into the database.
    -   [ ] Hash passwords before saving to the database.
3.  **User Login:**
    -   [ ] Create login form in `views/pages/login.php`.
    -   [ ] Implement `handleLogin()` in `controllers/UserController.php` to authenticate users.
    -   [ ] Implement `findUserByEmail()` in `models/User.php` to retrieve user data.
    -   [ ] Manage user sessions.
4.  **User Logout:**
    -   [ ] Implement `handleLogout()` in `controllers/UserController.php` to destroy the session.
5.  **User Profile:**
    -   [ ] Create `views/pages/profile.php`.
    -   [ ] Implement logic to display user information.

### Phase 2: Calendar & Meetings

1.  **Meeting Creation:**
    -   [ ] Create meeting creation form in `views/pages/dashboard.php`.
    -   [ ] Implement `createMeeting()` in `controllers/MeetingController.php`.
    -   [ ] Implement `createMeeting()` in `models/Meeting.php`.
2.  **Meeting Display:**
    -   [ ] Implement calendar view in `views/pages/dashboard.php`.
    -   [ ] Implement `getMeetingsForUser()` in `models/Meeting.php`.
    -   [ ] Display user's meetings on the calendar.
3.  **Meeting Invitations:**
    -   [ ] Implement user search functionality.
    -   [ ] Implement `inviteParticipant()` in `controllers/MeetingController.php`.
    -   [ ] Implement `addParticipant()` in `models/Meeting.php`.
4.  **Meeting Notifications:**
    -   [ ] Display notifications for pending meeting invitations.
    -   [ ] Implement `updateParticipantStatus()` in `models/Meeting.php`.

---

## Progress Tracking

This section will be updated as development progresses. We will mark completed tasks in the "Development Plan" section.

### Completed
- Project setup (folder structure).
- Initial file creation.
- Detailed development plan created.
- Configured database connection in `config/database.php`.

### Next Steps
- Create `users` table in MySQL.
- Implement User Registration.