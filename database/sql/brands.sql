PRAGMA foreign_keys = false;

-- ----------------------------
-- Records of "brands"
-- ----------------------------
INSERT INTO "brands" VALUES (1, 'HONDA', NULL);
INSERT INTO "brands" VALUES (2, 'TOYOTA', NULL);
INSERT INTO "brands" VALUES (3, 'NISSAN', NULL);
INSERT INTO "brands" VALUES (4, 'PERODUA', NULL);
INSERT INTO "brands" VALUES (5, 'PROTON', NULL);

-- ----------------------------
-- Auto increment value for brands
-- ----------------------------
UPDATE "sqlite_sequence" SET seq = 5 WHERE name = 'brands';

PRAGMA foreign_keys = true;
