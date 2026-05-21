PRAGMA foreign_keys = false;

-- ----------------------------
-- Records of "users"
-- ----------------------------
INSERT INTO "users" VALUES (1, 'Administrator', 'admin@mail.com', NULL, '$2y$12$Z7waCJKW2/DsTf53mz6pHO7ZfSgdS4dIbd6Vjy4kVnn1DF0iEjSOy', 1, NULL, '2026-05-18 07:35:50', '2026-05-18 07:35:50');
INSERT INTO "users" VALUES (2, 'Nurul Jannah', 'jannah@mail.com', NULL, '$2y$12$Z7waCJKW2/DsTf53mz6pHO7ZfSgdS4dIbd6Vjy4kVnn1DF0iEjSOy', 0, NULL, '2026-05-18 07:35:50', '2026-05-18 07:35:50');
INSERT INTO "users" VALUES (3, 'Wong Mei Cheng', 'meicheng@mail.com', NULL, '$2y$12$Z7waCJKW2/DsTf53mz6pHO7ZfSgdS4dIbd6Vjy4kVnn1DF0iEjSOy', 0, NULL, '2026-05-18 07:35:50', '2026-05-18 07:35:50');
INSERT INTO "users" VALUES (4, 'P. Pradeep', 'pradeep@mail.com', NULL, '$2y$12$Z7waCJKW2/DsTf53mz6pHO7ZfSgdS4dIbd6Vjy4kVnn1DF0iEjSOy', 0, NULL, '2026-05-18 07:35:50', '2026-05-18 07:35:50');
INSERT INTO "users" VALUES (5, 'Liew Chai Tong', 'liew@mail.com', NULL, '$2y$12$Z7waCJKW2/DsTf53mz6pHO7ZfSgdS4dIbd6Vjy4kVnn1DF0iEjSOy', 0, NULL, '2026-05-18 07:35:50', '2026-05-18 07:35:50');
INSERT INTO "users" VALUES (7, 'Mohammad Zaidi', 'zaidi@company.com', NULL, '$2y$12$5.3E16FnNPMvXuYiZNB7jOcFFy0ukFRd6bcO3b1hVw2o41cDnHlbW', 0, NULL, '2026-05-18 07:35:50', '2026-05-18 07:35:50');
INSERT INTO "users" VALUES (8, 'Razak Ahmad', 'razak@company.com', NULL, '$2y$12$/aoKBdaq95p4YhPlTLmdfONRQuabAIxkVfHyyuRcnVCQwwLTDKMi.', 0, NULL, '2026-05-18 07:35:50', '2026-05-18 07:35:50');
INSERT INTO "users" VALUES (9, 'Aman Adnan', 'aman@company.com', NULL, '$2y$12$2g0zyWOUCYcxd4aLJib2ouNIjL/pb6esQaQM14WrHkxsrnkIHWWSi', 0, NULL, '2026-05-18 07:35:50', '2026-05-18 07:35:50');

-- ----------------------------
-- Auto increment value for users
-- ----------------------------
UPDATE "sqlite_sequence" SET seq = 9 WHERE name = 'users';

PRAGMA foreign_keys = true;
