CREATE TABLE `posts` (
  `postID` INT NOT NULL AUTO_INCREMENT,
  `userID` INT NOT NULL,
  `textvalue` TEXT NOT NULL,
  PRIMARY KEY (`postID`),
  FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
);