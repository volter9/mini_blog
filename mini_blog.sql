-- phpMyAdmin SQL Dump
-- version 4.1.13
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2015 at 01:08 AM
-- Server version: 5.6.22
-- PHP Version: 5.5.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mini_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `url` varchar(80) NOT NULL,
  `description` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `url` (`url`),
  KEY `url_2` (`url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `url`, `description`) VALUES
(1, 'Others', 'other', 'Other stuff'),
(2, 'Cool category', 'cool-stuff', 'Cool description');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `privileges` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `privileges`) VALUES
(1, 'admins', '');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `url` varchar(80) NOT NULL,
  `description` varchar(500) NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`category_id`),
  KEY `category_id` (`category_id`),
  KEY `url` (`url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `url`, `description`, `text`, `date`, `user_id`, `category_id`) VALUES
(1, 'Natural Sort in MySQL', 'title', 'Once upon a time, in the far far galaxy, there was a developer who wrote his websites using pure procedural PHP with global variables. Other maintainers were shocked by the structure of our developer.\r\n– "Global variables are evil! They''re bad, and bla bla bla" – reply of any maintainer, but the problem wasn''t in the global variables, but in organization of website''s structure...', '> Once upon a time, in the far far galaxy, there was a developer who wrote his websites using pure procedural PHP with global variables. Other maintainers were shocked by the structure of our developer.\r\n> – "Global variables are evil! They''re bad, and bla bla bla" – reply of any maintainer, but the problem wasn''t in the global variables, but in organization of website''s structure...\r\n\r\nGlobal variables, singletons, or exposure is not evil. There''s no right and wrong about global variables, global variable is just a tool. Any tool has it''s own cases where it needed to be used. The problem is always in organization of code. Any problem in architecture *can* be solved by reorganizing structure and setting rules on the code base.\r\n\r\nThe problem with global variables that they can be initialized anywhere, and could be modified anywhere too. Global variables should be **read-only access**, and all of them should be initialized in the *bootstrap* or in beginning of program/script execution with their purposes.\r\n\r\nConsider this code:\r\n\r\n```php\r\n$a = 1;\r\n$b = 2;\r\n$c = 3;\r\n\r\nfunction sum () {\r\n    global $a, $b, $c, $d, $e;\r\n    \r\n    return $a * $b * $c * $d * $e;\r\n}\r\n\r\n$d = 4;\r\n$e = 10;\r\n\r\necho sum();\r\n```\r\n\r\nThis script can be easily reorganized into following structure:\r\n\r\n```php\r\n// index.php\r\n\r\nrequire ''variables.php'';\r\nrequire ''functions.php'';\r\n\r\necho sum();\r\n```\r\n\r\n```php \r\n// variables.php\r\n\r\n$a = 1;\r\n$b = 2;\r\n$c = 3;\r\n$d = 4;\r\n$e = 10;\r\n```\r\n\r\n```php \r\n// functions.php\r\n\r\nfunction sum () {\r\n    global $a, $b, $c, $d, $e;\r\n    \r\n    return $a * $b * $c * $d * $e;\r\n}\r\n```\r\n\r\nThis example is very banal and *useless*, but if you''ve got the idea, you should understand how to use global variables the *right way*.', '2015-01-04 03:54:14', 1, 1),
(2, 'Another cool title', 'other', 'First, PHP by itself is one of the easiest programming languages. There’s might be some obstacles to overcome by designers, but it’s still easier than C/C++ or Java (though, they don’t have anything related to template engines). Still, it’s not really hard to learn «echo» stuff, basic conditions (if, else, else if) and iterating through array.', 'Hello!\r\n\r\nI like OOP rather than procedural/functional programming. That''s my preference. Today, I want to talk about OOP beginner tutorials, but more specifically OOP examples. In most of OOP tutorials ( [here](http://www.tutorialspoint.com/php/php_object_oriented.htm), [here](http://simpledeveloper.com/object-oriented-programming-in-java-inheritance/), and even [here](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Introduction_to_Object-Oriented_JavaScript)) there are bullshit OOP examples, literally, bullshit examples. Those examples considered "real world" (real world analogies) examples, but OOP [isn''t a real-world thing](http://vimeo.com/43380467) (~18:20). That''s why examples shouldn''t be "real world" examples (even game dev OOP examples).\r\n\r\nOOP tutorials shouldn''t be based on some "imaginary" examples such as animal and cat inheritance, and person constructor. That''s ridiculous. Any learning process should involve some kind of lab, project or assignment. In other words practice. That''s why those examples are suck. They''re not practical, they''re useless.\r\n\r\nFor each language and technology, there''s should be dedicated OOP examples. For web dev, example can be a MVC basic boilerplate, or a simple template engine. For game dev, entity composition, simple rendering engine or a sound system. Those examples probably hard, but they''re right, they''re practical and useful.\r\n\r\nThat''s my 2 cents.', '2015-01-05 03:29:39', 1, 2),
(3, 'PHP, you''re way too cool', 'php-is-cool', 'Today, I''m going to chit chat about PHP and its forgiveness to its users, but first I''ll start from HTML and browser wars. Why? Because I said so, and it''s related to forgiveness.', 'Hello guys!\r\n\r\nToday, I''m going to chit chat about PHP and its forgiveness to its users, but first I''ll start from HTML and browser wars. Why? Because I said so, and it''s related to forgiveness.\r\n\r\nI''ve heard about those times when IE 5 was the best browser compared to other browsers on the market back in ol'' days (can you believe it?!). Netscape Navigator 4 was the beast of the jungle, any slightest mistake of designer was turned into the white ~~flames of the doom~~ blank page. As browsers grew and evolved, they learned to forgive designers'' errors (I don''t even dare to mention about HTML5 and its ~~bullshit~~ optional closing tags).\r\n\r\nLet''s get back to PHP. In PHP you can mess up a lot of stuff, but PHP will continue to work. There''s exceptions (not throwable exceptions) of course. Semicolons, and other syntax errors aren''t forgivable, but everything else is forgivable. Let''s take a look at some examples.\r\n\r\n## 1. Almost everything is **case insensitive**\r\n\r\nGuess what? You can write almost everything in any case, just look at that:\r\n\r\n```php\r\nfunction a () {}\r\n\r\nfunction A () {}\r\n```\r\n\r\nThis will trigger the error. Function ''a'' and function ''A'' are the same function, so "it means I can write my scripts in any case?" Heck yes! You can, but you *shouldn''t* actually. Just look at this "wonderful" code:\r\n\r\n```php\r\neChO ''Hello, '';\r\nPRINT(''world!'');\r\n```\r\n\r\nThis feature can be very fun to play with, but never ever do it in development, kids. This would cause readability problems.\r\n\r\nCase insensitivity affects following structures:\r\n\r\n* Control flow structures (if, else, while, class, as, etc.)\r\n* Language structures (echo, list, etc.)\r\n* Functions names\r\n* Class names\r\n* Types (int, string, double, etc.)\r\n* Booleans (true and false)\r\n\r\nThis ~~bug~~ feature is not working with variables, object properties, object constants,  and constants, though.\r\n\r\nWant to see some "pretty" code with this feature, well, ok, be careful though:\r\n\r\n```php\r\nClaSS A \r\n{\r\n	pubLIC $a = '''';\r\n	PUBLIC $b = '''';\r\n	\r\n	pUBLic FunctIon __ConSTRUCT ($a, $b) {\r\n		$this->a = $a;\r\n		$this->b = $b;\r\n	}\r\n	\r\n	puBLIC fuNCTION fOo () {\r\n		eCHO "{$this->a}, {$this->b}";\r\n	}\r\n}\r\n\r\n$a = new A(''Hello'', ''world!'');\r\n$a->FoO();\r\n```\r\n\r\nYou''ve probably liked it, huh? Me too.\r\n\r\n## 2. "Dear user, it''s a warning notice"\r\n\r\nNotices are easy to deal with, however, I think they''re useless. You can STFU them with @, or just check for failure before executing the function. In my opinion, every notice or warning should be replaced by ~~an error~~ a catchable exception in PHP.\r\n\r\nFor array access though, it would be nice if PHP would return `null` or `false` instead of "undefined offset notice" (as JS returns `undefined` for non existent properties or array indices).\r\n\r\nThat''s pretty much it.', '2015-01-11 21:16:55', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `mail` varchar(80) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `group_id_2` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `mail`, `group_id`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@example.com', 1),
(2, '_private', 'abc_def', 'volter25@gmail.com', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
