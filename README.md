# PathsOnMap-Corfu-server

Το PathsOnMap Corfu είναι μια εφαρμογή Android που σκοπό έχει να προτρέψει τους χρήστες να ανεβάζουν τις διαδρομές που κάνουν με τα πόδια, στην Κέρκυρα. Αυτό πετυχαίνεται με την παιχνιδοποίηση της εφαρμογής. Ο τελικός στόχος είναι να δημιουργηθεί ένας χάρτης πεζών για την Κέρκυρα. 
Εδώ παρουσιάζεται ο server της εφαρμογής. Αυτός αποθηκεύει τις διαδρομές σε ένα φάκελο με όνομα upload. Επίσης αποθηκεύει τα προφίλ των χρηστών που συνδέονται στην εφαρμογή, τα χαρακτηριστικά των διαδρομών που ανεβάζουν και τις κριτικές που κάνουν στις διαδρομές σε μία βάση δεδομένων.
Επίσης, εξομαλύνει της διαδρομές που ανεβάζουν οι χρήστες. Επιπλέον, δίνει τη δυνατότητα να εμφανίζεται ο χάρτης πεζών που έχει δημιουργηθεί, από μια σελίδα HTML. Τέλος, δίνεται η δυνατότητα στους διαχειριστές να δουν και να σχολιάσουν τις διαδρομές που ανεβάζουν οι χρήστες, ως νέες ή παλιές, μέσα από μια σελίδα HTML.

##Τεχνολογίες και εργαλεία

 - Apache
 - PHP
 - MySQL
 - HTML 5
 - CSS 3
 - JavaScript
 - JQuery 
 - Google Maps JavaScript API 

Ο server εκτελείται αυτή την στιγμή στο: http://corfu.pathsonmap.eu/

##Κατασκευή του κώδικα

 1. Εγκατάσταση [WampServer](http://www.wampserver.com/en/)
 2. Πηγαίνεται στο phpMyAdmin και δημιουργήστε μια βάση δεδομένων με όνομα: pa277408_mapmaker2
 3. Τρέξτε το ερώτημα SQL: 

> -- phpMyAdmin SQL Dump
>-- version 4.0.10.7
>-- http://www.phpmyadmin.net
>--
>-- Φιλοξενητής: localhost
>-- Χρόνος δημιουργίας: 02 Ιουλ 2015 στις 20:33:47
>-- Έκδοση διακομιστή: 10.0.17-MariaDB-cll-lve
>-- Έκδοση PHP: 5.4.31

>SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
>SET time_zone = "+00:00";
>
>--
>-- Βάση: `pa277408_mapmaker2`
>--
>
>-- --------------------------------------------------------
>
>--
>-- Δομή πίνακα για τον πίνακα `paths`
>--
>
>CREATE TABLE IF NOT EXISTS `paths` (
>  `uid` int(11) NOT NULL AUTO_INCREMENT,
>  `player_id` int(11) NOT NULL,
>  `path_raw_google_gpx` varchar(100) NOT NULL,
>  `path_smooth_google_gpx` varchar(100) NOT NULL,
>  `path_raw_gps_gpx` varchar(100) NOT NULL,
>  `tags` int(11) NOT NULL,
>  `meters` int(11) NOT NULL,
>   `new_path` tinyint(1) DEFAULT '1',
>  `created_at` datetime DEFAULT NULL,
>  `updated_at` datetime DEFAULT NULL,
>  PRIMARY KEY (`uid`)
>) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;
>
>-- --------------------------------------------------------
>
>--
>-- Δομή πίνακα για τον πίνακα `players`
>--
>
>CREATE TABLE IF NOT EXISTS `players` (
>  `uid` int(11) NOT NULL AUTO_INCREMENT,
>  `name` varchar(50) NOT NULL,
>  `email` varchar(100) NOT NULL,
>  `encrypted_password` varchar(80) NOT NULL,
>  `salt` varchar(10) NOT NULL,
>  `created_at` datetime DEFAULT NULL,
>  `updated_at` datetime DEFAULT NULL,
>  PRIMARY KEY (`uid`),
>  UNIQUE KEY `email` (`email`)
>) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;
>
>-- --------------------------------------------------------
>
>--
>-- Δομή πίνακα για τον πίνακα `reviews`
>--
>
>CREATE TABLE IF NOT EXISTS `reviews` (
>  `uid` int(11) NOT NULL AUTO_INCREMENT,
>  `player_id` int(11) NOT NULL,
>  `path_id` int(11) NOT NULL,
>  `rated` int(1) NOT NULL,
>  `rated_tags` int(1) NOT NULL,
>  `created_at` datetime DEFAULT NULL,
>  `updated_at` datetime DEFAULT NULL,
>  PRIMARY KEY (`uid`)
>) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
>
>-- --------------------------------------------------------
>
>--
>-- Δομή πίνακα για τον πίνακα `users`
>--
>
>CREATE TABLE IF NOT EXISTS `users` (
> `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
> `username` varchar(50) NOT NULL,
>  `password` varchar(50) NOT NULL,
>  PRIMARY KEY (`id`)
>) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

 4. Καταβάστε (download) τον κώδικα από: https://github.com/ippokratis1/PathsOnMap-Corfu-server.git
 5. Αντιγράψτε τον στο φάκελο www.
 6. Δημιουργήστε έναν administrator από το phpMyAdmin

###Έτοιμος κώδικας που χρησιμοποιήθηκε: 

 - https://github.com/peplin/gpxviewer : Προβολή GPX αρχείων
