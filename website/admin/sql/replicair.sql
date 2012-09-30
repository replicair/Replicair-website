create TABLE news (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  titleShort VARCHAR(255) NOT NULL DEFAULT 'News short title',
  abstract TEXT NOT NULL,
  abstractShort VARCHAR(255) NOT NULL DEFAULT 'News short abstract',
  datas TEXT NOT NULL,
  image VARCHAR(255) NOT NULL,
  state INT NOT NULL,
  dateOut DATETIME NOT NULL
  );
 / 
 create TABLE slideshow (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  subtitle VARCHAR(255) NOT NULL,
  datas TEXT NOT NULL,
  image VARCHAR(255),
  position INT NOT NULL,
  state INT NOT NULL
  );
 / 
  create TABLE press_review (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  sourceInfo VARCHAR(255) NOT NULL,
  author VARCHAR(255) NOT NULL,
  label VARCHAR(255) NOT NULL,
  url TEXT,
  filename VARCHAR(255),
  dateEvent DATETIME NOT NULL,
  state INT NOT NULL
  );
/
create TABLE article (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  category VARCHAR(255) NOT NULL,
  position INT NOT NULL,
  contentShow TEXT NOT NULL,
  contentHidden TEXT,
  image VARCHAR(255) NOT NULL,
  state INT NOT NULL,
  dateOut DATETIME NOT NULL
  );
 / 
  