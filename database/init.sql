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
    suspended bool ,
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
    foreign key (tag_id) REFERENCES Tags(id) ,
    foreign key (cours_id) REFERENCES Cours(id) ,
    PRIMARY KEY (id)
);

CREATE TABLE Cours 
(
    id INT AUTO_INCREMENT ,
    title VARCHAR(500) UNIQUE ,
    description TEXT ,
    content text ,
    cat_id INT ,
    isArchive BOOLEAN ,
    created_at DATE NOT NULL ,
    updated_at DATE NULL,
    deleted_at DATE NULL,
    foreign key (cat_id) REFERENCES Categories(id) ,
    PRIMARY KEY (id)
);


CREATE TABLE Inscription
(
    user_id INT ,
    cour_id INT ,
    created_at DATE NOT NULL ,
    foreign key (user_id) REFERENCES User(id) ,
    foreign key (cour_id) REFERENCES Cours(id) ,
    PRIMARY KEY (user_id , cour_id) 
);


CREATE TRIGGER set_isActive_before_insert
BEFORE INSERT ON User
FOR EACH ROW
BEGIN
    IF NEW.role_id = 2 THEN
        SET NEW.isActive = FALSE;
    ELSE
        SET NEW.isActive = TRUE;
    END IF;
END

INSERT INTO Roles (name) VALUES 
('Etudiant'), 
('Enseignant'),
('Admin')
;

INSERT INTO User (role_id, name, email, password, photo, isActive, suspended , deleted_at) VALUES
(1, 'Alice Dupont', 'alice.dupont@example.com', 'password123', 'alice.jpg', TRUE, NULL),
(1, 'Bob Martin', 'bob.martin@example.com', 'password123', 'bob.jpg', TRUE, NULL),
(2, 'Claire Thomas', 'claire.thomas@example.com', 'password123', 'claire.jpg', TRUE, NULL),
(2, 'David Simon', 'david.simon@example.com', 'password123', 'david.jpg', TRUE, NULL),
(3, 'ismail dilali', 'ismail@gmail.com', '1234', 'david.jpg', TRUE, NULL);

INSERT INTO Categories (name, created_at) VALUES 
('Photography', CURDATE()),
('Music', CURDATE()),
('Art & Creativity', CURDATE()),
('Technology', CURDATE()),
('Finance & Accounting', CURDATE()),
('Software Development', CURDATE()),
('Leadership', CURDATE()),
('Self-Improvement', CURDATE()),
('Parenting & Relationships', CURDATE()),
('Science & Research', CURDATE()),
('Writing & Publishing', CURDATE()),
('Career Development', CURDATE()),
('Gaming', CURDATE()),
('Sports & Adventure', CURDATE()),
('Environmental Studies', CURDATE()),
('Psychology', CURDATE()),
('Entrepreneurship', CURDATE()),
('Web Development', CURDATE()),
('Cryptocurrency & Blockchain', CURDATE()),
('AI & Machine Learning', CURDATE()),
('Public Speaking', CURDATE()),
('History & Culture', CURDATE()),
('Spirituality & Mindfulness', CURDATE()),
('Project Management', CURDATE());

INSERT INTO Categories (name, created_at) VALUES 
('software engineer', CURDATE());

INSERT INTO Tags (title, created_at) VALUES 
('Web Development', CURDATE()), 
('App Development', CURDATE()), 
('UX/UI Design', CURDATE()), 
('SEO', CURDATE()), 
('Content Marketing', CURDATE()), 
('Data Analysis', CURDATE()), 
('Machine Learning', CURDATE()), 
('Deep Learning', CURDATE()), 
('Business Strategy', CURDATE()), 
('Startup Culture', CURDATE()), 
('Personal Branding', CURDATE()), 
('Resume Writing', CURDATE()), 
('Interview Prep', CURDATE()), 
('Emotional Intelligence', CURDATE()), 
('Self-Care', CURDATE()), 
('Positive Thinking', CURDATE()), 
('Digital Art', CURDATE()), 
('Character Design', CURDATE()), 
('Video Editing', CURDATE()), 
('Podcasting', CURDATE()), 
('Violin', CURDATE()), 
('Piano', CURDATE()), 
('Guitar', CURDATE()), 
('Fitness Coaching', CURDATE()), 
('Pilates', CURDATE()), 
('Marathon Training', CURDATE()), 
('Nutrition', CURDATE()), 
('Weight Loss', CURDATE()), 
('Vegan Cooking', CURDATE()), 
('Travel Hacks', CURDATE()), 
('Remote Work', CURDATE()), 
('AI Tools', CURDATE()), 
('Cloud Computing', CURDATE()), 
('Blockchain', CURDATE()), 
('Cybersecurity', CURDATE()), 
('Robotics', CURDATE()), 
('Physics', CURDATE()), 
('Astronomy', CURDATE()), 
('Psychotherapy', CURDATE()), 
('World History', CURDATE()), 
('Cultural Studies', CURDATE()), 
('Sustainable Living', CURDATE()), 
('Green Energy', CURDATE()), 
('E-commerce', CURDATE()), 
('Dropshipping', CURDATE()), 
('Fashion Design', CURDATE()), 
('Interior Design', CURDATE()), 
('Language Learning', CURDATE()), 
('Online Teaching', CURDATE()), 
('Parenting Tips', CURDATE()), 
('Pet Care', CURDATE());






INSERT INTO Cours (title, description, content, cat_id, isArchive, created_at) VALUES
('Introduction à la Programmation', 
 'Ce cours vous enseigne les bases de la programmation en utilisant des exemples simples et des exercices pratiques.', 
 'https://www.youtube.com/embed/W6NZfCO5SIk?si=kVx1S9z8Abw0Yr6D', 
 1, 
 0, 
 CURDATE()),

('Principes de Design Graphique', 
 'Apprenez les concepts clés du design graphique, y compris la typographie, la couleur et la mise en page.', 
 'https://www.youtube.com/embed/SnxFkHqN1RA?si=-3H0WeV068wS72YO', 
 2, 
 0, 
 CURDATE()),

('Marketing Numérique pour Débutants', 
 'Découvrez les bases du marketing numérique, y compris le référencement, le marketing sur les réseaux sociaux et les campagnes publicitaires.', 
 'https://www.youtube.com/embed/e8wJBq6vOAI?si=7bwG26kkY9LXiBMV', 
 3, 
 0, 
 CURDATE()),

('Introduction à la Data Science', 
 'Apprenez les bases de la science des données, y compris le nettoyage des données, les visualisations et les modèles de base.', 
 'https://www.youtube.com/embed/xxpc-HPKN28?si=ZPUSkGI6ueQ2p6Ho', 
 4, 
 0, 
 CURDATE()),

('Développement Personnel : Gestion du Temps', 
 'Améliorez votre gestion du temps et augmentez votre productivité grâce à ce cours pratique.', 
 'https://www.youtube.com/embed/eOOmP6IUtOk?si=_KI2_nQ94n9aCtWT', 
 6, 
 0, 
 CURDATE());

INSERT INTO CoursTags (tag_id, cours_id) VALUES
(1, 1), -- Tag "PHP" associé au cours "Introduction à la Programmation"
(2, 1), -- Tag "JavaScript" associé au cours "Introduction à la Programmation"
(4, 1), -- Tag "Python" associé au cours "Introduction à la Programmation"

(16, 2), -- Tag "Graphic Design" associé au cours "Principes de Design Graphique"
(18, 2), -- Tag "Drawing" associé au cours "Principes de Design Graphique"
(19, 2), -- Tag "Painting" associé au cours "Principes de Design Graphique"

(12, 3), -- Tag "Marketing" associé au cours "Marketing Numérique pour Débutants"
(11, 3), -- Tag "Entrepreneurship" associé au cours "Marketing Numérique pour Débutants"

(4, 4), -- Tag "Python" associé au cours "Introduction à la Data Science"
(7, 4), -- Tag "SQL" associé au cours "Introduction à la Data Science"
(8, 4), -- Tag "Docker" associé au cours "Introduction à la Data Science"

(23, 5), -- Tag "Time Management" associé au cours "Développement Personnel : Gestion du Temps"
(24, 5), -- Tag "Stress Management" associé au cours "Développement Personnel : Gestion du Temps"
(25, 5); 





select `Cours`.id, Cours.title , Cours.description , Cours.content, Cours.author , Categories.name ,Categories.id as CategiId,
GROUP_CONCAT(`Tags`.title) as tags , GROUP_CONCAT(`Tags`.id) as Tags_id 
from Cours inner join `Categories` on `Categories`.id = `Cours`.cat_id 
inner join `CoursTags` on Cours.id = `CoursTags`.cours_id
inner join `User` on User.id = Cours.author
inner join `Tags` on Tags.id = `CoursTags`.tag_id 
where Cours.deleted_at is NULL and Cours.title LIKE '%Principes%' or Cours.description LIKE '%Principes%'
GROUP BY `Cours`.id, Cours.title , Cours.description , Cours.content , Categories.name  ;

select * from `Inscription` ;

Insert Into `Inscription`(user_id,cour_id,created_at) VALUES (4,3,CURRENT_DATE);

Alter Table `Cours` add column photo text ;

select `Cours`.id, Cours.title , Cours.description , Cours.content, Cours.author , Categories.name , User.name as Auth ,Categories.id as CategiId 
from Cours
inner join `Inscription` on `Inscription`.cour_id = `Cours`.id
inner join `Categories` on `Categories`.id = `Cours`.cat_id 
inner join `User` on User.id = Cours.author 
where Cours.deleted_at is NULL and user_id = 4
GROUP BY `Cours`.id, Cours.title , Cours.description , Cours.content , Categories.name  ;


select * from `Inscription`;


select COUNT(*) from `Cours` where Cours.author = 14 and deleted_at is NULL ;

SELECT COUNT(*) FROM Cours WHERE deleted_at IS NULL


select * from `Cours` limit 6 OFFSET 1


select COUNT(*) from `Cours`


select `Cours`.title ,cour_id , COUNT(user_id) as Users 
from `Inscription` INNER join `Cours` on `Inscription`.cour_id = Cours.id
 GROUP BY cour_id ORDER BY Users DESC LIMIT 1;

select  `Categories`.name , COUNT(Cours.id)
from `Cours` INNER join `Categories` on `Cours`.cat_id = `Categories`.id 
GROUP BY `Categories`.name 



select cour_id , COUNT(user_id )  from `Inscription`
where cour_id = 1
 GROUP BY cour_id


SELECT  * , `Inscription`.user_id  from `Inscription`
inner join `Cours` on `Cours`.id = `Inscription`.cour_id
inner join `User` on `User`.id = `Cours`.author 


select * from `Inscription`

select * from User

select * from `Cours`


SELECT COUNT(i.user_id) FROM `Inscription` i
JOIN (SELECT * FROM `Cours` WHERE author = 14) c ON c.id = i.cour_id;


select * from `User` ;

select * from `Cours` where Cours.`isArchive` is NULL


select `Categories`.name , COUNT(`Cours`.id) from `Categories` where `Categories`.created_at > '2025-01-21';


