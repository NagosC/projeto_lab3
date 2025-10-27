CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE meetings (
  id INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  start_time DATETIME NOT NULL,
  end_time DATETIME NOT NULL,
  creator_id INT,
  FOREIGN KEY (creator_id) REFERENCES users(id)
);

CREATE TABLE meeting_participants (
  meeting_id INT,
  user_id INT,
  status ENUM('pending', 'accepted') DEFAULT 'pending',
  PRIMARY KEY (meeting_id, user_id),
  FOREIGN KEY (meeting_id) REFERENCES meetings(id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);