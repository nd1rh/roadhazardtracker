-- 1. Create Database and Select it
CREATE DATABASE IF NOT EXISTS hazard_tracker;
USE hazard_tracker;

-- 2. Create Table Structure
CREATE TABLE IF NOT EXISTS hazards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    location_name VARCHAR(255) NOT NULL,
    latitude DECIMAL(10, 8) NOT NULL,
    longitude DECIMAL(11, 8) NOT NULL,
    hazard_type ENUM('landslide', 'flood', 'road_closure', 'other') NOT NULL,
    reporter_name VARCHAR(100) NOT NULL,
    report_date DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Insert Sample Data (Terengganu, Pahang, and Kelantan Regions)

-- === RECENT HAZARDS (Will appear in JSON API / Last 36 Hours) ===

INSERT INTO hazards (location_name, latitude, longitude, hazard_type, reporter_name, report_date) VALUES 
('Jalan Kuala Terengganu-Dungun (Near Chukai)', 4.230000, 103.420000, 'flood', 'Ahmad Faizal', NOW() - INTERVAL 2 HOUR),
('Cameron Highlands, Pahang (Near Tanah Rata)', 4.470000, 101.380000, 'landslide', 'Siti Sarah', NOW() - INTERVAL 5 HOUR),
('Kota Bharu Waterfront, Kelantan', 6.120000, 102.250000, 'flood', 'R. Muthu', NOW() - INTERVAL 8 HOUR),
('Taman Negara Entrance, Pahang', 4.390000, 102.400000, 'landslide', 'Tourist Info Ctr', NOW() - INTERVAL 12 HOUR),
('Jalan Kuantan-Marang, Terengganu', 5.210000, 103.200000, 'road_closure', 'Traffic Police HQ', NOW() - INTERVAL 15 HOUR),
('Pantai Redang, Terengganu', 5.770000, 103.010000, 'other', 'Marine Dept', NOW() - INTERVAL 20 HOUR),
('Genting Highlands Highway, Pahang', 3.420000, 101.790000, 'road_closure', 'PLUS Ronda', NOW() - INTERVAL 25 HOUR),
('Pasir Mas Market Area, Kelantan', 6.050000, 102.140000, 'flood', 'Local Merchant', NOW() - INTERVAL 30 HOUR),
('Kuala Tahan, Pahang', 4.380000, 102.430000, 'other', 'Park Ranger', NOW() - INTERVAL 34 HOUR);

-- === OLDER HAZARDS (Will NOT appear in JSON API / Older than 36 Hours) ===

INSERT INTO hazards (location_name, latitude, longitude, hazard_type, reporter_name, report_date) VALUES 
('Jalan Gua Musang-Jeli, Kelantan', 5.290000, 101.850000, 'landslide', 'JKR Gua Musang', NOW() - INTERVAL 2 DAY),
('Pekan Town Center, Pahang', 3.490000, 103.390000, 'flood', 'City Council', NOW() - INTERVAL 3 DAY),
('Kemaman Port, Terengganu', 4.240000, 103.440000, 'road_closure', 'Port Authority', NOW() - INTERVAL 5 DAY),
('Pantai Besut, Terengganu', 5.830000, 102.550000, 'flood', 'Hotel Assn', NOW() - INTERVAL 1 WEEK),
('Bentong Checkpoint, Pahang', 3.520000, 101.910000, 'other', 'Customs Officer', NOW() - INTERVAL 10 DAY),
('Tumpat Rice Fields, Kelantan', 6.200000, 102.170000, 'road_closure', 'Farm Manager', NOW() - INTERVAL 2 WEEK),
('Kuantan Main Road, Pahang', 3.820000, 103.330000, 'flood', 'Civil Defense', NOW() - INTERVAL 1 MONTH),
('Bachok, Kelantan (Jalan Pengkalan Chepa)', 6.050000, 102.400000, 'landslide', 'Villager', NOW() - INTERVAL 1 MONTH),
('Sultan Mahmud Bridge, Terengganu', 5.330000, 103.140000, 'flood', 'Drainage Dept', NOW() - INTERVAL 2 MONTH),
('Raub Mining Area, Pahang', 3.790000, 101.860000, 'road_closure', 'Security', NOW() - INTERVAL 3 MONTH),
('Setiu Wetlands, Terengganu', 5.650000, 102.700000, 'landslide', 'Eco Park Staff', NOW() - INTERVAL 4 MONTH);