

ALTER TABLE `evercisesessions`
  DROP CONSTRAINT `evercisesessions_evercisegroup_id_foreign`;


--
-- Dumping data for table `evercisegroups`
--

INSERT INTO `evercisegroups` (`id`, `user_id`, `category_id`, `venue_id`, `name`, `title`, `description`, `address`, `town`, `postcode`, `lat`, `lng`, `image`, `capacity`, `default_duration`, `default_price`, `published`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 2, 'Zool Class', '', 'Learn to play Zool Learn to play Zool Learn to play Zool Learn to play Zool Learn to play Zool Learn to play Zool Learn to play Zool', NULL, NULL, NULL, '0.00000000', '0.00000000', '1403018955_zool.png', 13, 35, '7.50', 0, '2014-06-17 14:30:53', '2014-06-17 14:30:53'),
(2, 2, 2, 3, 'Ducktales', '', 'Ducktales woo-oo-oo Ducktales woo-oo-oo Ducktales woo-oo-oo Ducktales woo-oo-oo Ducktales woo-oo-oo Ducktales woo-oo-oo ', NULL, NULL, NULL, '0.00000000', '0.00000000', '1403019080_Duck_Tales_Art.png', 15, 35, '24.00', 0, '2014-06-17 14:33:39', '2014-06-17 14:33:39'),
(3, 2, 3, 4, 'Adventure time', '', 'Adventure time, go grab your friends. Adventure time, go grab your friends. Adventure time, go grab your friends. Adventure time, go grab your friends. Adventure time, go grab your friends. ', NULL, NULL, NULL, '0.00000000', '0.00000000', '1403019250_adventure_time.jpg', 97, 80, '11.50', 0, '2014-06-17 14:35:14', '2014-06-17 14:35:14');

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `category`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Rowing Machine', 'facility', 'rowing.png', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(2, 'Toilets', 'Amenity', 'toilets', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(3, 'Car Park', 'Amenity', 'carpark', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(4, 'Hall', 'facility', 'hall', '2014-06-17 14:20:21', '2014-06-17 14:20:21');

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `sessionmember_id`, `session_id`, `evercisegroup_id`, `user_created_id`, `stars`, `comment`, `created_at`, `updated_at`) VALUES
(7, 2, 10, 12, 2, 4, 2, 'It was pretty exciting', '2014-06-17 15:29:27', '2014-06-17 15:29:27'),
(16, 1, 7, 14, 1, 4, 5, 'asdfs', '2014-06-18 10:18:13', '2014-06-18 10:18:13');

--
-- Dumping data for table `sessionmembers`
--

INSERT INTO `sessionmembers` (`id`, `user_id`, `evercisesession_id`, `price`, `reviewed`, `created_at`, `updated_at`) VALUES
(6, 3, 6, '0.00', 0, '2014-06-17 14:50:50', '2014-06-17 14:50:50'),
(7, 4, 14, '0.00', 0, '2014-06-17 14:51:51', '2014-06-17 14:51:51'),
(8, 4, 10, '0.00', 0, '2014-06-17 14:51:51', '2014-06-17 14:51:51'),
(9, 4, 11, '0.00', 0, '2014-06-17 14:52:23', '2014-06-17 14:52:23'),
(10, 4, 12, '0.00', 0, '2014-06-17 14:52:23', '2014-06-17 14:52:23'),
(11, 5, 15, '0.00', 0, '2014-06-17 14:56:45', '2014-06-17 14:56:45'),
(12, 5, 12, '0.00', 0, '2014-06-17 14:56:45', '2014-06-17 14:56:45'),
(13, 5, 1, '0.00', 0, '2014-06-17 14:57:10', '2014-06-17 14:57:10'),
(14, 5, 2, '0.00', 0, '2014-06-17 14:57:10', '2014-06-17 14:57:10'),
(15, 5, 3, '0.00', 0, '2014-06-17 14:57:10', '2014-06-17 14:57:10'),
(16, 5, 6, '0.00', 0, '2014-06-17 14:57:10', '2014-06-17 14:57:10'),
(17, 4, 6, '0.00', 0, '2014-06-17 15:14:16', '2014-06-17 15:14:16'),
(18, 4, 4, '0.00', 0, '2014-06-17 15:14:16', '2014-06-17 15:14:16'),
(19, 4, 3, '0.00', 0, '2014-06-17 15:14:16', '2014-06-17 15:14:16');

--
-- Dumping data for table `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`) VALUES
(1, 2, NULL, 0, 0, 0, NULL, NULL, NULL),
(2, 3, '::1', 0, 0, 0, NULL, NULL, NULL),
(3, 4, '::1', 0, 0, 0, NULL, NULL, NULL),
(4, 5, '::1', 0, 0, 0, NULL, NULL, NULL);

--
-- Dumping data for table `trainerhistory`
--

INSERT INTO `trainerhistory` (`id`, `user_id`, `historytype_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Tristan_Allen created Class Zool Class', '2014-06-17 14:30:53', '2014-06-17 14:30:53'),
(2, 2, 1, 'Tristan_Allen created Class Ducktales', '2014-06-17 14:33:39', '2014-06-17 14:33:39'),
(3, 2, 1, 'Tristan_Allen created Class Adventure time', '2014-06-17 14:35:14', '2014-06-17 14:35:14'),
(4, 2, 2, 'Tristan_Allen added a new date to Adventure time at 12:00pm on the 18th June 2014', '2014-06-17 14:35:25', '2014-06-17 14:35:25'),
(5, 2, 2, 'Tristan_Allen added a new date to Adventure time at 05:00pm on the 19th June 2014', '2014-06-17 14:35:35', '2014-06-17 14:35:35'),
(6, 2, 2, 'Tristan_Allen added a new date to Adventure time at 12:00pm on the 26th June 2014', '2014-06-17 14:35:42', '2014-06-17 14:35:42'),
(7, 2, 2, 'Tristan_Allen added a new date to Adventure time at 12:00pm on the 26th July 2014', '2014-06-17 14:35:52', '2014-06-17 14:35:52'),
(8, 2, 2, 'Tristan_Allen added a new date to Adventure time at 12:00pm on the 25th August 2014', '2014-06-17 14:36:03', '2014-06-17 14:36:03'),
(9, 2, 2, 'Tristan_Allen added a new date to Adventure time at 12:00pm on the 23rd October 2014', '2014-06-17 14:36:13', '2014-06-17 14:36:13'),
(10, 2, 2, 'Tristan_Allen added a new date to Zool Class at 12:00pm on the 19th June 2014', '2014-06-17 14:36:20', '2014-06-17 14:36:20'),
(11, 2, 2, 'Tristan_Allen added a new date to Zool Class at 12:00pm on the 18th July 2014', '2014-06-17 14:36:28', '2014-06-17 14:36:28'),
(12, 2, 2, 'Tristan_Allen added a new date to Zool Class at 12:00pm on the 06th August 2014', '2014-06-17 14:36:37', '2014-06-17 14:36:37'),
(13, 2, 2, 'Tristan_Allen added a new date to Zool Class at 12:00pm on the 19th July 2014', '2014-06-17 14:37:01', '2014-06-17 14:37:01'),
(14, 2, 2, 'Tristan_Allen added a new date to Ducktales at 07:00pm on the 18th June 2014', '2014-06-17 14:37:13', '2014-06-17 14:37:13'),
(15, 2, 2, 'Tristan_Allen added a new date to Ducktales at 05:00pm on the 03rd July 2014', '2014-06-17 14:37:24', '2014-06-17 14:37:24'),
(16, 2, 2, 'Tristan_Allen added a new date to Ducktales at 12:00pm on the 09th August 2014', '2014-06-17 14:37:33', '2014-06-17 14:37:33'),
(17, 2, 2, 'Tristan_Allen added a new date to Zool Class at 12:00pm on the 05th July 2014', '2014-06-17 14:37:39', '2014-06-17 14:37:39'),
(18, 2, 2, 'Tristan_Allen added a new date to Ducktales at 12:00pm on the 25th August 2014', '2014-06-17 14:37:49', '2014-06-17 14:37:49'),
(22, 2, 5, 'red ranger has joined Adventure time at 12:00pm on the 23rd October 2014', '2014-06-17 14:50:50', '2014-06-17 14:50:50'),
(23, 2, 5, 'yellow ranger has joined Zool Class at 12:00pm on the 05th July 2014', '2014-06-17 14:51:51', '2014-06-17 14:51:51'),
(24, 2, 5, 'yellow ranger has joined Zool Class at 12:00pm on the 19th July 2014', '2014-06-17 14:51:51', '2014-06-17 14:51:51'),
(25, 2, 5, 'yellow ranger has joined Ducktales at 07:00pm on the 18th June 2014', '2014-06-17 14:52:23', '2014-06-17 14:52:23'),
(26, 2, 5, 'yellow ranger has joined Ducktales at 05:00pm on the 03rd July 2014', '2014-06-17 14:52:23', '2014-06-17 14:52:23'),
(27, 2, 5, 'green ranger has joined Ducktales at 05:00pm on the 03rd July 2014', '2014-06-17 14:56:45', '2014-06-17 14:56:45'),
(28, 2, 5, 'green ranger has joined Ducktales at 12:00pm on the 25th August 2014', '2014-06-17 14:56:45', '2014-06-17 14:56:45'),
(29, 2, 5, 'green ranger has joined Adventure time at 12:00pm on the 18th June 2014', '2014-06-17 14:57:10', '2014-06-17 14:57:10'),
(30, 2, 5, 'green ranger has joined Adventure time at 05:00pm on the 19th June 2014', '2014-06-17 14:57:10', '2014-06-17 14:57:10'),
(31, 2, 5, 'green ranger has joined Adventure time at 12:00pm on the 26th June 2014', '2014-06-17 14:57:10', '2014-06-17 14:57:10'),
(32, 2, 5, 'green ranger has joined Adventure time at 12:00pm on the 23rd October 2014', '2014-06-17 14:57:10', '2014-06-17 14:57:10'),
(33, 2, 5, 'yellow ranger has joined Adventure time at 12:00pm on the 23rd May 2014', '2014-06-17 15:14:16', '2014-06-17 15:14:16'),
(34, 2, 5, 'yellow ranger has joined Adventure time at 12:00pm on the 26th June 2014', '2014-06-17 15:14:16', '2014-06-17 15:14:16'),
(35, 2, 5, 'yellow ranger has joined Adventure time at 12:00pm on the 26th July 2014', '2014-06-17 15:14:16', '2014-06-17 15:14:16'),
(37, 2, 6, 'yellow ranger has left a review of Zool Class at 12:00pm on the 18th June 2014', '2014-06-17 15:29:27', '2014-06-17 15:29:27'),
(39, 2, 6, 'yellow ranger has left a review of Zool Class at 12:03pm on the 07th March 2014', '2014-06-18 10:00:58', '2014-06-18 10:00:58'),
(40, 2, 6, 'yellow ranger has left a review of Ducktales at 12:00pm on the 23rd May 2014', '2014-06-18 10:02:33', '2014-06-18 10:02:33'),
(41, 1, 6, 'yellow ranger has left a review of Adventure time at 12:00pm on the 23rd May 2014', '2014-06-18 10:11:13', '2014-06-18 10:11:13'),
(42, 2, 6, 'yellow ranger has left a review of Zool Class at 12:03pm on the 07th March 2014', '2014-06-18 10:13:34', '2014-06-18 10:13:34'),
(43, 2, 6, 'yellow ranger has left a review of Zool Class at 12:03pm on the 07th March 2014', '2014-06-18 10:14:01', '2014-06-18 10:14:01'),
(44, 2, 6, 'yellow ranger has left a review of Adventure time at 12:00pm on the 23rd May 2014', '2014-06-18 10:14:52', '2014-06-18 10:14:52'),
(45, 4, 6, 'yellow ranger has left a review of Zool Class at 12:03pm on the 07th March 2014', '2014-06-18 10:17:08', '2014-06-18 10:17:08'),
(46, 1, 6, 'yellow ranger has left a review of Zool Class at 12:03pm on the 07th March 2014', '2014-06-18 10:18:13', '2014-06-18 10:18:13'),
(47, 2, 6, 'yellow ranger has left a review of Zool Class at 12:00pm on the 23rd May 2014', '2014-06-18 10:23:23', '2014-06-18 10:23:23');

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `user_id`, `bio`, `website`, `specialities_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'Invader Zim Invader Zim Invader Zim Invader Zim Invader Zim Invader Zim Invader Zim ', '', 5, '2014-06-17 14:28:17', '2014-06-17 14:28:17');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `created_at`, `updated_at`, `display_name`, `gender`, `dob`, `phone`, `directory`, `image`, `categories`, `remember_token`) VALUES
(1, 'admin@evercise.com', '$2y$10$OzLeZoVjb2292Z8TljBKaOdPRIhEZqNuqv0qpUxyBETaBSvRTdZBm', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-06-17 14:20:21', '2014-06-17 14:20:21', '', 0, '0000-00-00 00:00:00', '', '', '', '', NULL),
(2, 'furryfool@gmail.com', '$2y$10$rdJPaqQWgXkMAAKtOiA8wePBFYVC5Ua1Y4dvX2Ykh.z6IC43riKgq', NULL, 1, NULL, NULL, '2014-06-18 13:41:13', '$2y$10$VcozfeYGFzEnQxANPSoCc.9Vz8MHfMzMsSZoGGmsvJeo2bVo49pGu', NULL, 'Invader', 'Zim', '2014-06-17 14:20:36', '2014-06-18 13:41:13', 'Tristan_Allen', 1, '1970-01-22 00:00:00', '', '2014-06/2_Tristan_Allen', '1403018463_4226.jpg', '', NULL),
(3, 'red@ranger.com', '$2y$10$bD.lufaoOCbYtMUd3y2XueWzGsm4X4V4tB99Zhv4ZX0apW9igHDEO', NULL, 1, '', NULL, '2014-06-17 14:58:37', '$2y$10$gX.WLalIjmPV1Y53BDmuJ.aYsWY87GRhqX0foo6X9KW.FLhohUYpm', NULL, 'red', 'ranger', '2014-06-17 14:22:33', '2014-06-17 14:58:37', 'red ranger', 1, '1984-06-06 23:00:00', '', '2014-06/3_red ranger', '1403019513_6177574_orig.jpg', '', NULL),
(4, 'yellow@ranger.com', '$2y$10$tfuZV/f11td0rRvQ4ivQDuMrJxfH.O4ntG2oy5oJ.GSQjKuSG5FxW', NULL, 1, '', NULL, '2014-06-18 09:07:11', '$2y$10$YmxK3kSE5RNZqmma02DP4.RE30siQwEhuzI74QzhB.KOdHBGGOPpe', NULL, 'yellow', 'ranger', '2014-06-17 14:23:22', '2014-06-18 09:07:11', 'yellow ranger', 2, '1984-06-28 23:00:00', '', '2014-06/4_yellow ranger', '1403020755_6177574_orig.jpg', '', NULL),
(5, 'green@ranger.com', '$2y$10$suFT9/bSLDSDmbZacP7iBenrkHdVz/AA2Mrkq/C2IIuiOAJisCCZ2', NULL, 1, '', NULL, '2014-06-17 14:52:51', '$2y$10$Nbq0RyuIz93123AAy1eKreMT9ZSFbuUkBUBNQPmfbZsEHP5nNlHAS', NULL, 'green', 'ranger', '2014-06-17 14:24:03', '2014-06-17 14:53:15', 'green ranger', 1, '1974-06-05 23:00:00', '', '2014-06/5_green ranger', '1403020393_6177574_orig.jpg', '', NULL);

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`user_id`, `group_id`) VALUES
(1, 4),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(4, 1),
(5, 1);

--
-- Dumping data for table `user_marketingpreferences`
--

INSERT INTO `user_marketingpreferences` (`user_id`, `marketingpreference_id`, `created_at`, `updated_at`) VALUES
(2, 1, '2014-06-17 14:20:36', '2014-06-17 14:20:36');

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `user_id`, `name`, `address`, `town`, `postcode`, `lat`, `lng`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Greenlight', 'Cally Road', 'London', 'h4', '51.50682494', '-0.15704746', '', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(2, 2, 'brent cross', '', 'Londonbrent cross', '', '51.57635890', '-0.22369560', '', '2014-06-17 14:30:03', '2014-06-17 14:30:03'),
(3, 2, 'Abergavenny', '', 'abergavenny', '', '51.82536600', '-3.01942300', '', '2014-06-17 14:33:31', '2014-06-17 14:33:31'),
(4, 2, 'Ooo', '', 'ooo', '', '36.01075890', '10.31169500', '', '2014-06-17 14:35:04', '2014-06-17 14:35:04');


--
-- Dumping data for table `venue_facilities`
--

INSERT INTO `venue_facilities` (`venue_id`, `facility_id`, `details`, `created_at`, `updated_at`) VALUES
(2, 2, '', '2014-06-17 14:30:03', '2014-06-17 14:30:03'),
(2, 3, '', '2014-06-17 14:30:03', '2014-06-17 14:30:03'),
(3, 1, '', '2014-06-17 14:33:31', '2014-06-17 14:33:31'),
(4, 2, '', '2014-06-17 14:35:04', '2014-06-17 14:35:04');


--
-- Constraints for table `evercisegroups`
--
ALTER TABLE `evercisegroups`
  ADD CONSTRAINT `evercisegroups_venue_id_foreign` FOREIGN KEY (`venue_id`) REFERENCES `venues` (`id`),
  ADD CONSTRAINT `evercisegroups_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `evercisegroups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `evercisesessions`
--
ALTER TABLE `evercisesessions`
  ADD CONSTRAINT `evercisesessions_evercisegroup_id_foreign` FOREIGN KEY (`evercisegroup_id`) REFERENCES `evercisegroups` (`id`);

--
-- Constraints for table `featuredgymgroups`
--
ALTER TABLE `featuredgymgroups`
  ADD CONSTRAINT `featuredgymgroups_evercisegroup_id_foreign` FOREIGN KEY (`evercisegroup_id`) REFERENCES `evercisegroups` (`id`),
  ADD CONSTRAINT `featuredgymgroups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `gyms`
--
ALTER TABLE `gyms`
  ADD CONSTRAINT `gyms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `gym_has_trainers`
--
ALTER TABLE `gym_has_trainers`
  ADD CONSTRAINT `gym_has_trainers_gym_id_foreign` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`id`),
  ADD CONSTRAINT `gym_has_trainers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_user_created_id_foreign` FOREIGN KEY (`user_created_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ratings_evercisegroup_id_foreign` FOREIGN KEY (`evercisegroup_id`) REFERENCES `evercisegroups` (`id`),
  ADD CONSTRAINT `ratings_sessionmember_id_foreign` FOREIGN KEY (`sessionmember_id`) REFERENCES `sessionmembers` (`id`),
  ADD CONSTRAINT `ratings_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `evercisesessions` (`id`),
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sessionmembers`
--
ALTER TABLE `sessionmembers`
  ADD CONSTRAINT `sessionmembers_evercisesession_id_foreign` FOREIGN KEY (`evercisesession_id`) REFERENCES `evercisesessions` (`id`),
  ADD CONSTRAINT `sessionmembers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `trainerhistory`
--
ALTER TABLE `trainerhistory`
  ADD CONSTRAINT `trainerhistory_historytype_id_foreign` FOREIGN KEY (`historytype_id`) REFERENCES `historytypes` (`id`),
  ADD CONSTRAINT `trainerhistory_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `trainers`
--
ALTER TABLE `trainers`
  ADD CONSTRAINT `trainers_specialities_id_foreign` FOREIGN KEY (`specialities_id`) REFERENCES `specialities` (`id`),
  ADD CONSTRAINT `trainers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_has_categories`
--
ALTER TABLE `user_has_categories`
  ADD CONSTRAINT `user_has_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `user_has_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_marketingpreferences`
--
ALTER TABLE `user_marketingpreferences`
  ADD CONSTRAINT `user_marketingpreferences_marketingpreference_id_foreign` FOREIGN KEY (`marketingpreference_id`) REFERENCES `marketingpreferences` (`id`),
  ADD CONSTRAINT `user_marketingpreferences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `venues`
--
ALTER TABLE `venues`
  ADD CONSTRAINT `venues_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `venue_facilities`
--
ALTER TABLE `venue_facilities`
  ADD CONSTRAINT `venue_facilities_facility_id_foreign` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`),
  ADD CONSTRAINT `venue_facilities_venue_id_foreign` FOREIGN KEY (`venue_id`) REFERENCES `venues` (`id`);
