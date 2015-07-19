﻿# PathsOnMap-Corfu-server

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

##Κατασκευή του κώδικα (τοπικά)

 1. Εγκατάσταση [WampServer](http://www.wampserver.com/en/)
 2. Τρέξτε τον WampServer και επιλέξτε Put Online
 3. Καταβάστε (download zip) τον κώδικα από: https://github.com/ippokratis1/PathsOnMap-Corfu-server.git
 4. Αποσυμπιέστε τον φάκελο
 5. Αλλάξτε το όνομα του root directory (PathsOnMap-Corfu-server-master) σε mapmaker_local
 6. Kάντε αποκοπή επικόληση του φακέλου στον φάκελο www του WampServer που βρίσκεται στην διαδρομή c:/wamp/www
 7. Ανοίξτε ένα browser και πηγαίνετε στην διεύθυνση: localhost. Από την σελίδα που θα εμφανιστεί επιλέξτε phpmyadmin
 8. Δημιουργήστε μια νέα βάση δεδομένω επιλέγοντας Νέα και στην συνέχεια γράψτε για όνομα της βάσης δεδομένων: pa277408_mapmaker2 και για σύνθεση: utf8_general_ci και κάντε κλικ στο κουμπί *Δημιουργία*
 9. Επιλέξτε την βάση που δημιουργήσατε και πατήστε στην ετικέτα *Δικαιώματα*. Στην συνέχεια επιλέξτε *Προσθήκη χρήστη*. Από εκεί γράψτε για όνομα χρήστη: pa277408_ippokra, για φιλοξενητή: localhost και για κωδικό πρόσβασης: !lissos78. Επιλέξτε από Βάση δεδομένων για χρήστη: πλήρη διακιώματα και από Γενικά δικαιώματα: Επιλογή όλων. Μετά πατήστε στο κουμπί: *Εκτέλεση*
 10. Επιλέξτε την ετικέτα Κώδικας SQL και τρέξτε το ερώτημα SQL: 

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

 11. Η διεύθυνση που τρέχει ο server μπορεί να βρεθεί (στα Windows 7) επιλέγοντας Έναρξη-->Πίνακας Ελέγχου-->Κέντρο δικτύου και κοινής χρήσης-->Σύνδεση (ασύρματου) δικτύου-->Λεπτομέρεις... και από εκεί είναι η Διεύθυνση IPv4 και μετά mapmaker_local, π.χ.: 192.168.1.65
 12. **Δημιουργία διαχειριστών**: Επιλέξτε τον πίνακα *pa277408_mapmaker2* και πατήστε στην καρτέλα *Κώδικας SQL*. Στη συνέχεια τρέξτε π.χ. το ερώτημα SQL:
 

> INSERT  INTO `users` 
>       (`username` , `password` )
>
>VALUES ('john',  SHA1('johnPsw' ) ), 
>       ('james', SHA1('jamesPsw') ),
>       ('jim',   SHA1('jimPsw'  ) );



 
###Έτοιμος κώδικας που χρησιμοποιήθηκε: 

 - https://github.com/peplin/gpxviewer : Προβολή GPX αρχείων


