use  Youdemy ;

CREATE TABLE Roles
(
    id INT AUTO_INCREMENT ,
    name VARCHAR(500) ,
    PRIMARY KEY (id)
);
CREATE TABLE User
(
    id INT AUTO_INCREMENT ,
    role_id INT ,
    name VARCHAR(500) ,
    email VARCHAR(500) Unique ,
    password VARCHAR(500) ,
    photo text ,
    isActive bool,
    deleted_at date ,
    PRIMARY KEY (id) ,
    foreign key (role_id) REFERENCES Roles(id) ON UPDATE CASCADE
    ON DELETE CASCADE
);
CREATE TABLE Categories
(
    id INT AUTO_INCREMENT ,
    name VARCHAR(500) UNIQUE ,
    PRIMARY KEY (id),
    created_at DATE NOT NULL ,
    updated_at DATE NULL,
    deleted_at DATE NULL
);

CREATE TABLE Tags
(
    id INT AUTO_INCREMENT ,
    title VARCHAR(500) UNIQUE,
    PRIMARY KEY (id),
    created_at DATE NOT NULL ,
    updated_at DATE NULL,
    deleted_at DATE NULL
);

CREATE TABLE CoursTags
(
    id INT AUTO_INCREMENT ,
    tag_id INT NOT NULL ,
    cours_id INT NOT NULL,
    foreign key (tag_id) REFERENCES Tags(id) ON UPDATE cascade
    ON DELETE cascade ,
    foreign key (cours_id) REFERENCES Cours(id) ON UPDATE cascade
    ON DELETE cascade,
    PRIMARY KEY (id)
);

CREATE TABLE Cours
(
    id INT AUTO_INCREMENT ,
    title VARCHAR(500) UNIQUE ,
    description TEXT ,
    content text ,
    cat_id INT ,
    tags INT  ,
    isArchive BOOLEAN ,
    created_at DATE NOT NULL ,
    updated_at DATE NULL,
    deleted_at DATE NULL,
    foreign key (cat_id) REFERENCES Categories(id) ON UPDATE cascade
    ON DELETE SET NULL ,
    PRIMARY KEY (id)
);
CREATE TABLE Inscription
(
    user_id INT ,
    cour_id INT ,
    created_at DATE NOT NULL ,
    foreign key (user_id) REFERENCES User(id) ON UPDATE cascade
    ON DELETE cascade ,
    foreign key (cour_id) REFERENCES Cours(id) ON UPDATE cascade
    ON DELETE cascade,
    PRIMARY KEY (user_id , cour_id)
);

INSERT INTO Roles (name) VALUES 
('Etudiant'), 
('Enseignant'),
('Admin')
;

INSERT INTO User (role_id, name, email, password, photo, isActive, deleted_at) VALUES
(1, 'Alice Dupont', 'alice.dupont@example.com', 'password123', 'alice.jpg', TRUE, NULL),
(1, 'Bob Martin', 'bob.martin@example.com', 'password123', 'bob.jpg', TRUE, NULL),
(2, 'Claire Thomas', 'claire.thomas@example.com', 'password123', 'claire.jpg', TRUE, NULL),
(2, 'David Simon', 'david.simon@example.com', 'password123', 'david.jpg', TRUE, NULL),
(3, 'ismail dilali', 'ismail@gmail.com', '1234', 'david.jpg', TRUE, NULL);

INSERT INTO Categories (name, created_at) VALUES 
('Programmation', CURDATE()), 
('Design', CURDATE()), 
('Marketing', CURDATE()), 
('Data Science', CURDATE());

INSERT INTO Categories (name, created_at) VALUES 
('Business', CURDATE()), 
('Personal Development', CURDATE()), 
('Languages', CURDATE()), 
('Health & Fitness', CURDATE()), 
('Cooking & Culinary', CURDATE()), 
('Travel & Lifestyle', CURDATE());

INSERT INTO Tags (title, created_at) VALUES 
('PHP', CURDATE()), 
('JavaScript', CURDATE()), 
('HTML', CURDATE()), 
('Python', CURDATE()), 
('Java', CURDATE()), 
('C++', CURDATE()), 
('SQL', CURDATE()), 
('Docker', CURDATE()), 
('AWS', CURDATE()), 
('Leadership', CURDATE()), 
('Entrepreneurship', CURDATE()), 
('Marketing', CURDATE()), 
('Finance', CURDATE()), 
('Accounting', CURDATE()), 
('Project Management', CURDATE()), 
('Graphic Design', CURDATE()), 
('Photography', CURDATE()), 
('Drawing', CURDATE()), 
('Painting', CURDATE()), 
('Music Production', CURDATE()), 
('Dance', CURDATE()), 
('Public Speaking', CURDATE()), 
('Time Management', CURDATE()), 
('Stress Management', CURDATE()), 
('Mindfulness', CURDATE()), 
('Writing Skills', CURDATE()), 
('English', CURDATE()), 
('French', CURDATE()), 
('Spanish', CURDATE()), 
('German', CURDATE()), 
('Mandarin', CURDATE()), 
('Japanese', CURDATE()), 
('Cooking', CURDATE()), 
('Baking', CURDATE()), 
('Fitness', CURDATE()), 
('Yoga', CURDATE()), 
('Gardening', CURDATE()), 
('Travel Planning', CURDATE()), 
('Career Coaching', CURDATE());

INSERT INTO Cours (title, description, content, cat_id, isArchive, created_at) VALUES
('Learn PHP', 'Comprehensive PHP course for beginners.', 'php_course_content.pdf', 1, FALSE, CURDATE()),
('Graphic Design Basics', 'Introduction to the principles of graphic design.', 'design_course.pdf', 2, FALSE, CURDATE()),
('Digital Marketing', 'Learn SEO, PPC, and social media strategies.', 'marketing_course.mp4', 3, FALSE, CURDATE()),
('Data Science with Python', 'Use Python for data analysis and machine learning.', 'data_science_course.pdf', 4, FALSE, CURDATE());


select * from User;
