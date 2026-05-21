PRAGMA foreign_keys = false;

-- ----------------------------
-- Records of "models"
-- ----------------------------
INSERT INTO "models" VALUES (1, 'CITY HATCHBACK');
INSERT INTO "models" VALUES (2, 'CIVIC');
INSERT INTO "models" VALUES (3, 'VIOS');
INSERT INTO "models" VALUES (4, 'YARIS');
INSERT INTO "models" VALUES (5, 'ALPHARD');
INSERT INTO "models" VALUES (6, 'X50');
INSERT INTO "models" VALUES (7, 'S70');
INSERT INTO "models" VALUES (8, 'SAGA');
INSERT INTO "models" VALUES (9, 'SERENA');
INSERT INTO "models" VALUES (10, 'CITY');
INSERT INTO "models" VALUES (11, 'ALZA');
INSERT INTO "models" VALUES (12, 'HR-V');
INSERT INTO "models" VALUES (13, 'WR-V');
INSERT INTO "models" VALUES (14, 'ALMERA');
INSERT INTO "models" VALUES (15, 'X-TRAIL');
INSERT INTO "models" VALUES (16, 'AXIA');
INSERT INTO "models" VALUES (17, 'BEZZA');
INSERT INTO "models" VALUES (18, 'MYVI');
INSERT INTO "models" VALUES (19, 'ATIVA');
INSERT INTO "models" VALUES (20, 'TRAZ');
INSERT INTO "models" VALUES (21, 'ARUZ');

-- ----------------------------
-- Auto increment value for models
-- ----------------------------
UPDATE "sqlite_sequence" SET seq = 21 WHERE name = 'models';

PRAGMA foreign_keys = true;
