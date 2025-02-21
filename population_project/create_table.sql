CREATE TABLE prefecture_population (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prefecture VARCHAR(255) NOT NULL,
    year INT NOT NULL,
    population BIGINT NOT NULL
);