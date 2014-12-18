
DROP DATABASE csulalea_LeaugueServer;
CREATE DATABASE csulalea_LeaugueServer;
Use csulalea_LeaugueServer;


-- end of script 

-- add permissions to test on repository locally 
CREATE USER 'csulalea'@'localhost' IDENTIFIED BY 'programming';
GRANT ALL PRIVILEGES ON *.* TO 'csulalea'@'localhost';
FLUSH PRIVILEGES;



 
