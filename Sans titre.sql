CREATE TABLE `STATUS` (
  `status_id` integer(3) auto_increment,
  `role` varchar(250),
  PRIMARY KEY(`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `USER` (
  `user_id` integer(3) auto_increment,
  `name` varchar(250),
  `lastname` varchar(250),
  `mail` varchar(250),
  `password` varchar(250),
  `status_id` integer(3),
  `team_id` integer(3),
  PRIMARY KEY(`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `REQUEST` (
  `request_id` integer(3) auto_increment,
  `type` varchar(250),
  `status` varchar(250),
  `start_date` datetime,
  `end_date`datetime,
  `user_id` integer(3),
  PRIMARY KEY(`request_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `TEAM` (
  `team_id` integer(3) auto_increment,
  `name` varchar(250),
  PRIMARY KEY(`team_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `USER` ADD FOREIGN KEY (`status_id`) REFERENCES `STATUS` (`status_id`);
ALTER TABLE `USER` ADD FOREIGN KEY (`team_id`) REFERENCES `TEAM` (`team_id`);
ALTER TABLE `REQUEST` ADD FOREIGN KEY (`user_id`) REFERENCES `USER` (`user_id`);