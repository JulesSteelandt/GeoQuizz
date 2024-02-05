CREATE TABLE "user" (
                        id SERIAL PRIMARY KEY,
                        prenom VARCHAR(255),
                        nom VARCHAR(255)
);

CREATE TABLE serie (
                       id SERIAL PRIMARY KEY,
                       nom VARCHAR(255)
);

CREATE TABLE localisation (
                              id SERIAL PRIMARY KEY,
                              localisation_id INT,
                              serie_id INT,
                              FOREIGN KEY (serie_id) REFERENCES serie(id)
);

CREATE TABLE partie (
                        id SERIAL PRIMARY KEY,
                        user_id INT,
                        score INT,
                        difficulte INT,
                        serie_id INT,
                        FOREIGN KEY (serie_id) REFERENCES serie(id)
);

INSERT INTO serie (nom) VALUES
                            ('Serie A'),
                            ('Serie B'),
                            ('Serie C');

INSERT INTO localisation (localisation_id, serie_id) VALUES
                                                         (100, 1),
                                                         (200, 2),
                                                         (300, 3);

INSERT INTO partie (user_id, score, difficulte, serie_id) VALUES
                                                              (1, 100, 3, 1),
                                                              (2, 150, 4, 2),
                                                              (3, 120, 2, 3);
