--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id`          int(11)  NOT NULL        AUTO_INCREMENT,
  `name`        varchar(255) NOT NULL,
  `text`        TEXT NOT NULL,
  `author`      varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name` (`name`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;
