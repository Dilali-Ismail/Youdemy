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


drop table `Cours`;

CREATE TABLE Inscription
(
    user_id INT ,
    cour_id INT ,
    created_at DATE NOT NULL ,
    foreign key (user_id) REFERENCES User(id) ,
    foreign key (cour_id) REFERENCES Cours(id) ,
    PRIMARY KEY (user_id , cour_id) 
);

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
('Programmation', CURDATE()), 
('Design', CURDATE()), 
('Marketing', CURDATE()), 
('Data Science', CURDATE()),
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


select * from `Cours`;

SELECT User.id  , User.name , User.email ,Roles.name as role_title 
from User INNER JOIN Roles on Roles.id = User.role_id where User.role_id < 3 ;


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




select `Cours`.id, Cours.title , Cours.description , Cours.content  , Categories.name ,Categories.id as CategiId,
GROUP_CONCAT(`Tags`.title) as tags , GROUP_CONCAT(`Tags`.id) as Tags_id 
from Cours inner join `Categories` on `Categories`.id = `Cours`.cat_id
inner join `CoursTags` on Cours.id = `CoursTags`.cours_id
inner join `Tags` on Tags.id = `CoursTags`.tag_id 
where Cours.deleted_at is NULL 
GROUP BY `Cours`.id, Cours.title , Cours.description , Cours.content , Categories.name  ;


SHOW CREATE TABLE Cours;