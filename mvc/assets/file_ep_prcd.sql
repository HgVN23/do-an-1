-- 	UpdateTBDTKH410

BEGIN
DECLARE TongTC float DEFAULT 0;
DECLARE TongTCDTKH4 float DEFAULT 0;
DECLARE TongTCDTKH10 float DEFAULT 0;
DECLARE TBHKH10 float DEFAULT 0;
DECLARE TBHKH4 float DEFAULT 0;
DECLARE TongTCDKY float DEFAULT 0;
DECLARE tbtlh10 float DEFAULT 0;
DECLARE tbtlh4 float DEFAULT 0;
DECLARE KQtbtlh10 float DEFAULT 0;
DECLARE KQtbtlh4 float DEFAULT 0;


SELECT
SUM(Hp.SoTC),
SUM(Hp.SoTC * d.DiemTKH10),
SUM(Hp.SoTC * d.DiemTKH4)
INTO TongTC, TongTCDTKH10, TongTCDTKH4
FROM hocphan as hp
JOIN sinhvienhpdiemhk as svhpdhk
ON svhpdhk.MaHP = hp.MaHP
AND svhpdhk.MaHK = MaHK
AND svhpdhk.MaSV = (SELECT sv.MaSV from sinhvien as sv where sv.ID = ID)
JOIN diem AS d ON d.MaD = svhpdhk.MaD;

SET TBHKH10 = ROUND(TongTCDTKH10/TongTC, 2);
SET TBHKH4 = ROUND(TongTCDTKH4/TongTC, 2);


UPDATE ketqua as kq 
JOIN ketquasv as kqsv ON kqsv.MaDiemTK=kq.MaDiemTk 
JOIN sinhvien as sv ON sv.MaSV=kqsv.Masv and sv.ID=ID 
SET kq.DiemTK10=TBHKH10, kq.DiemTK4=TBHKH4  WHERE kq.MaHK=MaHK; 

SELECT SUM(HP.SoTC) INTO TongTCDKY
FROM hocphan as hp
JOIN sinhvienhpdiemhk as svhpdhk ON svhpdhk.MaHP = hp.MaHP
JOIN sinhvien AS SV on sv.MaSV = svhpdhk.MaSV AND sv.ID = ID
JOIN hocky AS HK ON HK.MaHK = svhpdhk.MaHK
JOIN ketqua AS KQ ON kq.MaHK = hk.MaHK
JOIN ketquasv as kqsv ON kqsv.MaDiemTK = kq.MaDiemTk AND kqsv.Masv = sv.MaSV
WHERE CAST(SUBSTRING(svhpdhk.MaHK, 3) AS UNSIGNED) <= CAST(SUBSTRING(MaHK, 3)AS UNSIGNED); 

select SUM(kq.DiemTK10 * kq.SoTCHK), SUM(kq.DiemTK4 * kq.SoTCHK) INTO tbtlh10, tbtlh4 
from ketqua as kq JOIN ketquasv as kqsv ON kqsv.MaDiemTK=kq.MaDiemTk 
JOIN sinhvien as sv ON sv.MaSV=kqsv.Masv AND sv.ID=ID 
WHERE CAST(SUBSTRING(kq.MaHK, 3) AS UNSIGNED) <=CAST(SUBSTRING(MaHK, 3)AS UNSIGNED); 

SET KQtbtlh4=round(tbtlh4/TongTCDKY, 2); 
SET KQtbtlh10=round(tbtlh10/TongTCDKY, 2); 

UPDATE ketqua as kq 
JOIN ketquasv as kqsv ON kqsv.MaDiemTK=kq.MaDiemTk 
JOIN sinhvien as sv ON sv.MaSV=kqsv.Masv and sv.ID=ID 
SET kq.TongSTCDK=TongTCDKY, KQ.SoTCHK=TongTC, KQ.DiemTBTLH10=KQtbtlh10, KQ.DiemTBTLH4=KQtbtlh4 WHERE kq.MaHK=MaHK; 
END

-- UpdateTBDTKH410 V2 THAY ID BẰNG MASV
-- DELIMITER $$
-- CREATE DEFINER=`` PROCEDURE `UpdateTBDTKH410`(IN `MaHK` CHAR(10), IN `MaSV` CHAR(10))
-- BEGIN
-- DECLARE TongTC float DEFAULT 0;
-- DECLARE TongTCDTKH4 float DEFAULT 0;
-- DECLARE TongTCDTKH10 float DEFAULT 0;
-- DECLARE TBHKH10 float DEFAULT 0;
-- DECLARE TBHKH4 float DEFAULT 0;
-- DECLARE TongTCDKY float DEFAULT 0;
-- DECLARE tbtlh10 float DEFAULT 0;
-- DECLARE tbtlh4 float DEFAULT 0;
-- DECLARE KQtbtlh10 float DEFAULT 0;
-- DECLARE KQtbtlh4 float DEFAULT 0;


-- SELECT
-- SUM(Hp.SoTC),
-- SUM(Hp.SoTC * d.DiemTKH10),
-- SUM(Hp.SoTC * d.DiemTKH4)
-- INTO TongTC, TongTCDTKH10, TongTCDTKH4
-- FROM hocphan as hp
-- JOIN sinhvienhpdiemhk as svhpdhk
-- ON svhpdhk.MaHP = hp.MaHP
-- AND svhpdhk.MaHK = MaHK
-- AND svhpdhk.MaSV = (SELECT sv.MaSV from sinhvien as sv where sv.MaSV = MaSV)
-- JOIN diem AS d ON d.MaD = svhpdhk.MaD;

-- SET TBHKH10 = ROUND(TongTCDTKH10/TongTC, 2);
-- SET TBHKH4 = ROUND(TongTCDTKH4/TongTC, 2);


-- UPDATE ketqua as kq 
-- JOIN ketquasv as kqsv ON kqsv.MaDiemTK=kq.MaDiemTk 
-- JOIN sinhvien as sv ON sv.MaSV=kqsv.Masv and sv.MaSV = MaSV
-- SET kq.DiemTK10=TBHKH10, kq.DiemTK4=TBHKH4  WHERE kq.MaHK=MaHK; 

-- SELECT SUM(HP.SoTC) INTO TongTCDKY
-- FROM hocphan as hp
-- JOIN sinhvienhpdiemhk as svhpdhk ON svhpdhk.MaHP = hp.MaHP
-- JOIN sinhvien AS SV on sv.MaSV = svhpdhk.MaSV AND sv.MaSV = MaSV
-- JOIN hocky AS HK ON HK.MaHK = svhpdhk.MaHK
-- JOIN ketqua AS KQ ON kq.MaHK = hk.MaHK
-- JOIN ketquasv as kqsv ON kqsv.MaDiemTK = kq.MaDiemTk AND kqsv.Masv = sv.MaSV
-- WHERE CAST(SUBSTRING(svhpdhk.MaHK, 3) AS UNSIGNED) <= CAST(SUBSTRING(MaHK, 3)AS UNSIGNED); 

-- select SUM(kq.DiemTK10 * kq.SoTCHK), SUM(kq.DiemTK4 * kq.SoTCHK) INTO tbtlh10, tbtlh4 
-- from ketqua as kq JOIN ketquasv as kqsv ON kqsv.MaDiemTK=kq.MaDiemTk 
-- JOIN sinhvien as sv ON sv.MaSV=kqsv.Masv AND sv.MaSV = MaSV 
-- WHERE CAST(SUBSTRING(kq.MaHK, 3) AS UNSIGNED) <=CAST(SUBSTRING(MaHK, 3)AS UNSIGNED); 

-- SET KQtbtlh4=round(tbtlh4/TongTCDKY, 2); 
-- SET KQtbtlh10=round(tbtlh10/TongTCDKY, 2); 

-- UPDATE ketqua as kq 
-- JOIN ketquasv as kqsv ON kqsv.MaDiemTK=kq.MaDiemTk 
-- JOIN sinhvien as sv ON sv.MaSV=kqsv.Masv and sv.MaSV = MaSV
-- SET kq.TongSTCDK=TongTCDKY, KQ.SoTCHK=TongTC, KQ.DiemTBTLH10=KQtbtlh10, KQ.DiemTBTLH4=KQtbtlh4 WHERE kq.MaHK=MaHK; 
-- END$$
-- DELIMITER ;




-- uPDATE TỔNG KẾT QUÁ TRÌNH V1
DELIMITER $$
CREATE DEFINER=`` PROCEDURE `UpdateTKQT`(IN `MaD` VARCHAR(50)))
UPDATE diem as d
SET d.DiemTKQT = (d.DiemCCan + d.DiemHS1 + 2*d.DiemHS2 + d.DiemTH)/5
WHERE d.MaD = MaD$$
DELIMITER ;

-- uPDATE TỔNG KẾT QUÁ TRÌNH V2
-- DELIMITER $$
-- CREATE DEFINER=`` PROCEDURE `UpdatediemTBQT`(IN `inputString` TEXT, IN `delimiterChar` CHAR(1))
-- BEGIN
--  DROP TEMPORARY TABLE IF EXISTS temp_string;
--  CREATE TEMPORARY TABLE temp_string(vals text); 
--  WHILE LOCATE(delimiterChar, inputString) > 1 DO
--     INSERT INTO temp_string SELECT SUBSTRING_INDEX(inputString,delimiterChar,1);
--     SET inputString = REPLACE(inputString, (SELECT LEFT(inputString, LOCATE(delimiterChar, inputString))),'');
--  END WHILE;
--  INSERT INTO temp_string(vals) VALUES (inputString);
-- UPDATE diem as d
-- SET d.DiemTKQT = (d.DiemCCan + d.DiemHS1 + 2*d.DiemHS2 + d.DiemTH)/5
-- WHERE d.MaD IN (SELECT TRIM(vals) FROM temp_string);
-- END$$
-- DELIMITER ;


-- update tông kết học phần
DELIMITER $$
CREATE DEFINER=`` PROCEDURE `UpdateDiemTKHP`(IN `MaD` CHAR(10))
BEGIN

UPDATE diem as d
SET d.DiemTKH10 = (d.DiemTKQT*0.4 + d.DiemThi*0.6) WHERE d.MaD = MaD;

UPDATE diem as d
    SET d.DiemTKH4 = CASE
        WHEN d.DiemTKH10 >= 9.0 THEN 4.0
        WHEN d.DiemTKH10 >= 8.5 THEN 3.7
        WHEN d.DiemTKH10 >= 8.0 THEN 3.5
        WHEN d.DiemTKH10 >= 7.0 THEN 3.0
        WHEN d.DiemTKH10 >= 6.5 THEN 2.5
        WHEN d.DiemTKH10 >= 5.5 THEN 2.0
        WHEN d.DiemTKH10 >= 5.0 THEN 1.5
        WHEN d.DiemTKH10 >= 4.0 THEN 1.0
        ELSE 0.0
 	END,
    d.DiemChu = CASE
           WHEN d.DiemTKH10 >= 9.0 THEN 'A+'
           WHEN d.DiemTKH10 >= 8.5 THEN 'A'
           WHEN d.DiemTKH10 >= 8.0 THEN 'B+'
           WHEN d.DiemTKH10 >= 7.0 THEN 'B'
           WHEN d.DiemTKH10 >= 6.5 THEN 'C+'
           WHEN d.DiemTKH10 >= 5.5 THEN 'C'
           WHEN d.DiemTKH10 >= 5.0 THEN 'D+'
           WHEN d.DiemTKH10 >= 4.0 THEN 'D'
           ELSE 'F'
           END,
    d.XepLoai = CASE
        WHEN d.DiemTKH10 >= 9.0 THEN 'Xuất sắc'
        WHEN d.DiemTKH10 >= 8.0 THEN 'Giỏi'
        WHEN d.DiemTKH10 >= 7.0 THEN 'Khá'
        WHEN d.DiemTKH10 >= 5.0 THEN 'Trung bình'
        WHEN d.DiemTKH10 >= 4.0 THEN 'Yếu'
        ELSE 'Kém'
	END
        WHERE d.MaD = MaD and d.DiemTKH10 IS NOT NULL;
END$$
DELIMITER ;


-- BEGIN
--  DROP TEMPORARY TABLE IF EXISTS temp_string;
--  CREATE TEMPORARY TABLE temp_string(vals text); 
--  WHILE LOCATE(delimiterChar, inputString) > 1 DO
--     INSERT INTO temp_string SELECT SUBSTRING_INDEX(inputString,delimiterChar,1);
--     SET inputString = REPLACE(inputString, (SELECT LEFT(inputString, LOCATE(delimiterChar, inputString))),'');
--  END WHILE;
--  INSERT INTO temp_string(vals) VALUES (inputString);

-- UPDATE diem as d
-- SET d.DiemTKH10 = (d.DiemTKQT*0.4 + d.DiemThi*0.6) WHERE d.MaD = MaD;

-- UPDATE diem as d
--     SET d.DiemTKH4 = CASE
--         WHEN d.DiemTKH10 >= 9.0 THEN 4.0
--         WHEN d.DiemTKH10 >= 8.5 THEN 3.7
--         WHEN d.DiemTKH10 >= 8.0 THEN 3.5
--         WHEN d.DiemTKH10 >= 7.0 THEN 3.0
--         WHEN d.DiemTKH10 >= 6.5 THEN 2.5
--         WHEN d.DiemTKH10 >= 5.5 THEN 2.0
--         WHEN d.DiemTKH10 >= 5.0 THEN 1.5
--         WHEN d.DiemTKH10 >= 4.0 THEN 1.0
--         ELSE 0.0
--  	END,
--     d.DiemChu = CASE
--            WHEN d.DiemTKH10 >= 9.0 THEN 'A+'
--            WHEN d.DiemTKH10 >= 8.5 THEN 'A'
--            WHEN d.DiemTKH10 >= 8.0 THEN 'B+'
--            WHEN d.DiemTKH10 >= 7.0 THEN 'B'
--            WHEN d.DiemTKH10 >= 6.5 THEN 'C+'
--            WHEN d.DiemTKH10 >= 5.5 THEN 'C'
--            WHEN d.DiemTKH10 >= 5.0 THEN 'D+'
--            WHEN d.DiemTKH10 >= 4.0 THEN 'D'
--            ELSE 'F'
--            END,
--     d.XepLoai = CASE
--         WHEN d.DiemTKH10 >= 9.0 THEN 'Xuất sắc'
--         WHEN d.DiemTKH10 >= 8.0 THEN 'Giỏi'
--         WHEN d.DiemTKH10 >= 7.0 THEN 'Khá'
--         WHEN d.DiemTKH10 >= 5.0 THEN 'Trung bình'
--         WHEN d.DiemTKH10 >= 4.0 THEN 'Yếu'
--         ELSE 'Kém'
-- 	END
--         WHERE d.MaD IN (SELECT TRIM(vals) FROM temp_string) and d.DiemTKH10 IS NOT NULL;
--         END
