drop database if exists `ccdonuts`;
CREATE DATABASE IF NOT EXISTS `ccdonuts` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
drop user if exists 'ccStaff'@'localhost';
create user 'ccStaff'@'localhost' identified by 'ccDonuts';
grant all on ccdonuts.* to 'ccStaff'@'localhost';
USE `ccdonuts`;

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `furigana` varchar(100) NOT NULL,
  `postcode_a` int(3) NOT NULL,
  `postcode_b` int(4) NOT NULL,
  `address` varchar(200) NOT NULL,
  `mail` varchar(100) NOT NULL UNIQUE,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `introduction` varchar(1000) NOT NULL,
  `is_new` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `creditData` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL UNIQUE,
  `name` varchar(100) NOT NULL,
  `creditNumber` varchar(19) NOT NULL,
  `creditCompany` varchar(100)  NOT NULL,
  `vpMonth` int(11) NOT NULL,
  `vpYear` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



INSERT INTO `products` (`id`, `name`, `price`, `introduction`, `is_new`) VALUES
(1, 'CCドーナツ 当店オリジナル（5個入り）', 1500, '当店のオリジナル商品、CCドーナツは、サクサクの食感が特徴のプレーンタイプのドーナツです。素材にこだわり、丁寧に揚げた生地は軽やかでサクッとした食感が楽しめます。口の中に広がる甘くて香ばしい香りと、口どけの良い食感が感じられます。', 0),
(2, 'チョコレートデライト（5個入り）', 1600, '濃厚なチョコレートコーティングが魅力の贅沢なドーナツです。丁寧に揚げた生地に、なめらかでコクのあるチョコレートをたっぷりとコーティングし、見た目にも美しく仕上げました。ふんわりとした生地の食感とチョコレートの深い甘みが口いっぱいに広がります。', 0),
(3, 'キャラメルクリーム（5個入り）', 1600, 'コク深いキャラメルの風味が楽しめる贅沢なドーナツです。丁寧に揚げた生地に、まろやかで香ばしいキャラメルクリームをかけ、上品な甘さに仕上げました。やさしい甘みと生地の軽やかな食感が広がり、満足感のある味わいをお楽しみいただけます。', 0),
(4, 'プレーンクラシック（5個入り）', 1500, '長く親しまれてきた定番スタイルを意識し、生地の味わいを主役にしたクラシックなドーナツです。控えめな甘さと素朴な風味で、飲み物との相性も良く、幅広い世代におすすめです。', 0),
(5, 'サマーシトラス（5個入り）', 1600, '新商品のサマーシトラスは、爽やかな柑橘の風味を楽しめる季節限定のドーナツです。丁寧に揚げた生地に、レモンやシトラスの香り豊かなグレーズをまとわせ、さっぱりとした味わいに仕上げました。みずみずしい柑橘の香りと軽やかな甘さが広がり、夏にぴったりの爽快な美味しさです。', 1),
(6, 'ストロベリークラッシュ（5個入り）', 1800, '甘酸っぱいストロベリーの風味と華やかな見た目が魅力のドーナツです。丁寧に揚げた生地にストロベリーフレーバーのカラフルなトッピングで可愛らしく仕上げました。、苺の爽やかな甘みと生地のやさしい食感が広がり、気分まで明るくなるような楽しい味わいです。', 0),
(7, 'フルーツドーナツセット（12個入り）', 3500, '新鮮で豊かなフルーツをたっぷりと使用した贅沢な12個入りセットです。このセットには、季節の最高のフルーツを厳選し、ドーナツに取り入れました。口に入れた瞬間にフルーツの風味と生地のハーモニーが広がります。色鮮やかな見た目も魅力の一つです。', 0),
(8, 'フルーツドーナツセット（14個入り）', 4000, '色とりどりのフルーツを贅沢にあしらった華やかな14個入りのセットです。旬のフルーツをふんだんにトッピングし、バリエーション豊かな仕上がりにしました。フルーツの爽やかな甘みと生地のやさしい風味が調和し、華やかな美味しさをお楽しみいただけます。', 0),
(9, 'ベストセレクションボックス（4個入り）', 1200, '人気フレーバーを厳選したお得なアソートセットです。定番から華やかな物まで、バリエーション豊かなに詰め合わせ、初めての方にもおすすめの内容に仕上げました。ご自宅用はもちろん、ちょっとしたギフトにもぴったりのセレクションをお楽しみいただけます。', 0),
(10, 'チョコクラッシュボックス（7個入り）', 2400, 'チョコレート系フレーバーを集中的に楽しめる、チョコ好き向けのアソートセットです。異なるチョコの質感やトッピングの違いを組み合わせ、食べ比べができる構成にしました。贈答用にもおすすめです。', 0),
(11, 'クリームボックス（4個入り）', 1400, 'なめらかなクリームやコーティングを楽しめるドーナツを詰め合わせたセットです。丁寧に揚げた生地に、やさしい甘さのクリームやグレーズを施し、上品で食べやすい味わいに仕上げました。ティータイムやちょっとしたご褒美に最適です。', 0),
(12, 'クリームボックス（9個入り）', 2800, 'クリーム系フレーバーを中心に多彩な味わいを楽しめるアソートセットです。丁寧に揚げたドーナツに、なめらかなクリームやコーティングを施し、見た目にも楽しい内容に仕上げました。ご家族や友人とのシェアにも最適なセットです。', 0);

ALTER TABLE `customers` ADD PRIMARY KEY (`id`);

ALTER TABLE `products` ADD PRIMARY KEY (`id`);

ALTER TABLE `creditData` ADD PRIMARY KEY (`id`);

ALTER TABLE `customers` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `products` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `creditData` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
