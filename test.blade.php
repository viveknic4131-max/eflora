-- ============================================
-- 🌿 Families
-- ============================================
INSERT INTO families ( family_code, name, description) VALUES
(UUID(), 'Fabaceae', 'Legume family, includes peas, beans, and acacias.'),
(UUID(), 'Asteraceae', 'Sunflower family, largest family of flowering plants.'),
(UUID(), 'Poaceae', 'Grass family, includes wheat, rice, and maize.'),
(UUID(), 'Orchidaceae', 'Orchid family, known for diverse and colorful flowers.'),
(UUID(), 'Rosaceae', 'Rose family, includes roses, apples, and strawberries.');

-- ============================================
-- 🌱 Genera
-- ============================================
INSERT INTO genus (genus_code, name, description, family_id) VALUES
-- Fabaceae
(UUID(), 'Acacia', 'Trees and shrubs with yellow flowers.', 1),
(UUID(), 'Pisum', 'Includes the garden pea.', 1),
(UUID(), 'Cicer', 'Includes chickpeas.', 1),
(UUID(), 'Glycine', 'Includes soybean.', 1),
(UUID(), 'Dalbergia', 'Includes rosewood trees.', 1),

-- Asteraceae
(UUID(), 'Helianthus', 'Sunflower genus.', 2),
(UUID(), 'Taraxacum', 'Includes dandelions.', 2),
(UUID(), 'Bellis', 'Includes common daisies.', 2),
(UUID(), 'Lactuca', 'Includes lettuce.', 2),
( UUID(), 'Centaurea', 'Includes knapweeds.', 2),

-- Poaceae
(UUID(), 'Oryza', 'Includes rice.', 3),
(UUID(), 'Triticum', 'Includes wheat.', 3),
(UUID(), 'Zea', 'Includes maize or corn.', 3),
(UUID(), 'Saccharum', 'Includes sugarcane.', 3),
(UUID(), 'Hordeum', 'Includes barley.', 3),

-- Orchidaceae
(UUID(), 'Phalaenopsis', 'Moth orchids.', 4),
(UUID(), 'Cattleya', 'Showy orchids.', 4),
(UUID(), 'Dendrobium', 'Tropical orchids.', 4),
(UUID(), 'Vanilla', 'Source of vanilla flavoring.', 4),
(UUID(), 'Paphiopedilum', 'Lady slipper orchids.', 4),

-- Rosaceae
(UUID(), 'Rosa', 'Includes true roses.', 5),
(UUID(), 'Malus', 'Includes apples.', 5),
(UUID(), 'Prunus', 'Includes cherries and almonds.', 5),
(UUID(), 'Fragaria', 'Includes strawberries.', 5),
(UUID(), 'Rubus', 'Includes raspberries and blackberries.', 5);

-- ============================================
-- 🌸 Species (real examples)
-- ============================================
INSERT INTO species (species_code, name, description, genus_id, family_id, author, publication, year_described, volume,
page, common_name) VALUES
-- Fabaceae: Acacia
(UUID(), 'Acacia dealbata', 'Silver wattle tree native to Australia.', 1, 1, 'Link', 'Flora Austr.', 1820, 'Vol 1', 45,
'Silver Wattle'),
(UUID(), 'Acacia nilotica', 'Common thorny tree found in Africa and India.', 1, 1, 'L.', 'Sp. Pl.', 1753, 'Vol 1', 12,
'Gum Arabic Tree'),

-- Pisum
(UUID(), 'Pisum sativum', 'Edible pea widely cultivated.', 2, 1, 'L.', 'Sp. Pl.', 1753, 'Vol 2', 33, 'Garden Pea'),

-- Cicer
(UUID(), 'Cicer arietinum', 'Cultivated chickpea.', 3, 1, 'L.', 'Sp. Pl.', 1753, 'Vol 2', 56, 'Chickpea'),

-- Glycine
(UUID(), 'Glycine max', 'Domesticated soybean.', 4, 1, 'L.', 'Sp. Pl.', 1753, 'Vol 3', 99, 'Soybean'),

-- Dalbergia
(UUID(), 'Dalbergia sissoo', 'Indian rosewood.', 5, 1, 'Roxb.', 'Flora Indica', 1832, 'Vol 4', 120, 'Shisham'),

-- Asteraceae
(UUID(), 'Helianthus annuus', 'Common sunflower.', 6, 2, 'L.', 'Sp. Pl.', 1753, 'Vol 5', 45, 'Sunflower'),
(UUID(), 'Taraxacum officinale', 'Common dandelion.', 7, 2, 'F.H. Wigg.', 'Prim. Fl.', 1780, 'Vol 6', 88, 'Dandelion'),
(UUID(), 'Bellis perennis', 'Common daisy.', 8, 2, 'L.', 'Sp. Pl.', 1753, 'Vol 6', 90, 'Daisy'),
(UUID(), 'Lactuca sativa', 'Garden lettuce.', 9, 2, 'L.', 'Sp. Pl.', 1753, 'Vol 6', 100, 'Lettuce'),
(UUID(), 'Centaurea cyanus', 'Cornflower.', 10, 2, 'L.', 'Sp. Pl.', 1753, 'Vol 6', 110, 'Cornflower'),

-- Poaceae
(UUID(), 'Oryza sativa', 'Cultivated rice.', 11, 3, 'L.', 'Sp. Pl.', 1753, 'Vol 7', 12, 'Rice'),
(UUID(), 'Triticum aestivum', 'Common wheat.', 12, 3, 'L.', 'Sp. Pl.', 1753, 'Vol 7', 15, 'Wheat'),
(UUID(), 'Zea mays', 'Maize or corn.', 13, 3, 'L.', 'Sp. Pl.', 1753, 'Vol 7', 20, 'Maize'),
(UUID(), 'Saccharum officinarum', 'Sugarcane.', 14, 3, 'L.', 'Sp. Pl.', 1753, 'Vol 7', 25, 'Sugarcane'),
(UUID(), 'Hordeum vulgare', 'Cultivated barley.', 15, 3, 'L.', 'Sp. Pl.', 1753, 'Vol 7', 30, 'Barley'),

-- Orchidaceae
(UUID(), 'Phalaenopsis amabilis', 'Moth orchid.', 16, 4, 'Blume', 'Bijdr.', 1825, 'Vol 8', 33, 'Moth Orchid'),
(UUID(), 'Cattleya labiata', 'Showy orchid native to Brazil.', 17, 4, 'Lindl.', 'Bot. Reg.', 1821, 'Vol 8', 35,
'Corsage Orchid'),
(UUID(), 'Dendrobium nobile', 'Noble dendrobium orchid.', 18, 4, 'Lindl.', 'Edwards Bot. Reg.', 1830, 'Vol 8', 40,
'Noble Orchid'),
(UUID(), 'Vanilla planifolia', 'Source of vanilla.', 19, 4, 'Andrews', 'Bot. Rep.', 1808, 'Vol 8', 50, 'Vanilla
Orchid'),
(UUID(), 'Paphiopedilum insigne', 'Lady slipper orchid.', 20, 4, 'Wall. ex Lindl.', 'Bot. Reg.', 1820, 'Vol 8', 60,
'Lady Slipper'),

-- Rosaceae
(UUID(), 'Rosa gallica', 'French rose.', 21, 5, 'L.', 'Sp. Pl.', 1753, 'Vol 9', 10, 'Gallic Rose'),
(UUID(), 'Malus domestica', 'Cultivated apple.', 22, 5, 'Borkh.', 'Theor. Prakt.', 1803, 'Vol 9', 12, 'Apple'),
(UUID(), 'Prunus avium', 'Wild cherry.', 23, 5, 'L.', 'Sp. Pl.', 1753, 'Vol 9', 20, 'Cherry'),
(UUID(), 'Fragaria vesca', 'Wild strawberry.', 24, 5, 'L.', 'Sp. Pl.', 1753, 'Vol 9', 25, 'Strawberry'),
(UUID(), 'Rubus idaeus', 'Raspberry.', 25, 5, 'L.', 'Sp. Pl.', 1753, 'Vol 9', 30, 'Raspberry');
