PRAGMA foreign_keys = false;

-- ----------------------------
-- Records of "type"
-- ----------------------------
INSERT INTO "type" VALUES (1, 'SEDAN');
INSERT INTO "type" VALUES (2, 'HATCHBACK');
INSERT INTO "type" VALUES (3, 'SUV');
INSERT INTO "type" VALUES (4, 'MPV');

-- ----------------------------
-- Auto increment value for type
-- ----------------------------
UPDATE "sqlite_sequence" SET seq = 4 WHERE name = 'type';

PRAGMA foreign_keys = true;
