-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 12, 2015 at 01:25 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ipodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `asisten`
--

CREATE TABLE IF NOT EXISTS `asisten` (
  `id_asisten` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `angkatan` varchar(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telepon` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id_asisten`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `asisten`
--

INSERT INTO `asisten` (`id_asisten`, `nama`, `angkatan`, `email`, `telepon`, `foto`) VALUES
(28, 'Budi', '2010', 'budi@gmail.com', '08132974897', 'ipo_kjvbsio.jpg'),
(35, 'Sergian', '2009', 'Egi@gmail.com', '0000', 'ipo_9220_155251742514_564557514_2629850_1402316_n.jpg'),
(37, 'Haryo Manon Sejato\\i', '1992', 'manon@gmail.com', '08xxxxxxx', 'ipo_Father.JPG'),
(33, 'Lalala', '2011', 'kupret@gmail.com', '27087542', 'ipo_558449_3469288936002_1859832456_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE IF NOT EXISTS `berita` (
  `id_berita` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(50) NOT NULL,
  `isi` varchar(10000) NOT NULL,
  `tanggal` int(11) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `tahun` int(11) NOT NULL,
  `kategori` int(2) NOT NULL,
  PRIMARY KEY (`id_berita`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `judul`, `isi`, `tanggal`, `bulan`, `tahun`, `kategori`) VALUES
(59, 'Owner PT. Cipta Adhi Prasetya', '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="../IPOLaboratory/tinymce/plugins/imagemanager/admin/aa/Father.JPG" alt="" width="121" height="177" /></p>\r\n<p style="text-align: center;"><span style="font-size: large;"><strong>Owner Of PT. Cipta Adhi Prasetya</strong></span></p>', 4, 'May', 13, 0),
(42, 'KSC 123', '<p><img src="../IPOLaboratory/tinymce/plugins/imagemanager/admin/aa/KSC_WEB.png" alt="" width="300" height="159" /></p>\r\n<p>Laboratorium Komputasi dan sistem Cerdas&nbsp;<img title="Laughing" src="tinymce/plugins/emotions/img/smiley-laughing.gif" border="0" alt="Laughing" /></p>\r\n<p>nclsakncaskl kjvhdwkj</p>', 13, 'Feb', 13, 0),
(41, 'IBG', '<p><img src="../IPOLaboratory/tinymce/plugins/imagemanager/admin/aa/.facebook_909103095.jpg" alt="" width="300" height="425" /></p>\r\n<p>fkuhdskabvki&nbsp;<img title="Cool" src="tinymce/plugins/emotions/img/smiley-cool.gif" border="0" alt="Cool" /></p>', 13, 'Feb', 13, 0),
(31, 'Klasiber Sudah Bisa Diakses', '<p>Diberitahukan bahwa untuk saat ini klasiber sudah bisa diakses kembali. Mohon maaf atas ketidaknyamanan untuk beberapa saat dan terimakasih.</p>', 13, 'Feb', 13, 0),
(33, 'COBA LAGI', '<p>Diberitahukan, bahwa saat ini klasiber mengalami gangguan teknis yang disebabkan padamnya listrik pada hari Jumat, 14 Desember 2012 sekitar pukul 10.45 WIB. Hal tersebut menyebabkan terganggunya koneksi antar database sehingga beberapa account mengalami kegagalan ketika log in. Demikian pemberitahuan ini disampaikan, atas perhatian dan kerjasamanya diucapkan terimakasih.</p>\r\n<p>Admin</p>', 13, 'Feb', 13, 0),
(35, 'kvjnw', '<p>Diberitahukan, bahwa saat ini klasiber mengalami gangguan teknis yang disebabkan padamnya listrik pada hari Jumat, 14 Desember 2012 sekitar pukul 10.45 WIB. Hal tersebut menyebabkan terganggunya koneksi antar database sehingga beberapa account mengalami kegagalan ketika log in. Demikian pemberitahuan ini disampaikan, atas perhatian dan kerjasamanya diucapkan terimakasih.</p>', 13, 'Feb', 13, 0),
(32, 'COba', '<p><span>Diberitahukan, bahwa saat ini klasiber mengalami gangguan teknis yang disebabkan padamnya listrik pada hari</span><span>&nbsp;Jumat, 14 Desem<span style="font-size: large;">ber 2012&nbsp;</span></span><span><span style="font-size: large;">s</span>ekitar pukul&nbsp;</span><span>10.45 W<span style="font-size: x-large;">IB</span></span><span><span style="font-size: x-large;">. Hal tersebut</span> menyebabkan terganggunya koneksi antar database sehingga beberapa account mengalami kegagalan ketika log in. Demikian pemberitahuan ini disampaikan, atas perhatian dan kerjasama<span style="font-size: x-large;">nya diucapkan</span> terimakasih.&nbsp;</span></p>', 13, 'Feb', 13, 0),
(60, 'PEMENANG LIPO BUSINESS PLAN 2013', '<p>LIPO Teknik Industri UII, Yogyakarta &mdash; Setelah melalui rangkaian praktikum Mata Kuliah Perancangan Organisasi dan Manajemen Bisnis Tahun Ajaran 2012/2013 di Laboratorium Inovasi dan Pengembangan Organisasi Teknik Industri Universitas Islam Indonesia, Mahasiswa dan Mahasiswi di akhir praktikum mendapatkan Tugas besar untuk membuat sebuah ide Business Plan yang kemudian di kompetisikan kepada seluruh praktikan yang diselenggarakan oleh Laboratorium IPO. 104 proposal Business Plan yang masuk ke dalam rangkaian praktikum dan proses seleksi apresiasi Business Plan Laboratorium IPO diseleksi oleh seluruh Asisten, Laboran dan Kepala Laboratorium Inovasi dan Pengembangan Organisasi dengan ragam dinamika dan perdebatan yang ada untuk memilih 10 besar dari ratusan proposal yang ada. Prodi Teknik Industri menyambut positif kegiatan yang dilakukan salah satu laboratoriumnya yang mampu berfikir Out Of The Box. Kepala Laboratorium IPO Nashrullah Setiawan,,S.T., M.Sc mengatakan &ldquo; Semua Ratusan Proposal dari praktikkan memiliki isi ( ide ) yang semuanya bagus , Kita kesulitan untuk mencari 10 besar yang nantinya akan mempresentasikan ide bisnisnya di depan juri eksternal, yang menghadirkan praktisi dan pengusaha muda (&nbsp; Taufiq Immawan. S.T., M.M &amp; Andika Kairuliawan S.Kom ).<br /><br />&nbsp;Asisten Laboran, dan Kepala Laboratorium IPO mengakui bahwa mahasiswa &ndash; mahasiswi Teknik Industri memiliki ide dan jiwa bisnis yang kreatif yang semuanya sebenarnya ide itu layak untuk di jalankan hanya perlu pelatihan yang lebih lanjut. Pungkasnya&rdquo;.&nbsp; Ada berbagai industri kreatif yang di usung dari setiap ide bisnisnya yaitu industri Fashion, Kuliner, Kerajinan, Seni dan budaya tradisional daerah semuanya itu memiliki prospek yang sangat menjanjikan apabila di seriuskan di masa yang akan datang.<br /><br />Rabu, 10 Juli 2013 sekitar pukul 09.00 &ndash; 15.00 WIB di Auditorium FTI UII terpilihlah 10 besar Peserta Kompetisi Business Plan LIPO 2013 yang selanjutnya presentasi di depan para juri , masing &ndash; masing kontestan mendapatkan masukan kritik dan saran terhadap presentasi ide bisnisnya baik kritik yang membangun maupun yang sangat pedas terhadap ide bisnisnya. Praktikan atau peserta berpendapat bahwa program ini merupakan proses pembelajaran bagi kita semua untuk menuju perlombaan Business Plan, PKM atau perlombaan &ndash; perlombaan lain yang berkaitan di lapangan yang sesungguhnya kelak baik ajang dalam lokal, nasional, maupun internasional.<br /><br />Pagelaran Apresiasi Business Plan yang dilakukan Laboratorium IPO merupakan pertama kalinya dan berjalan dengan lancar serta sukses. Akhirnya terpilihlah 3 besar yang mendapat award dari Laboratorium IPO dan Prodi Teknik Industri yang diumumkan pada hari Jum&rsquo;at, 19 Juli 2013 , sebagai Juara yaitu :<br /><br />Juara 1 &ldquo; MULFBAG&rdquo;<br /><br />( Ide bisnis mengenai Tas yang memiliki berbagai fungsi )<br /><br />Juara 2 &ldquo; TOSCA FRUIT &rdquo;<br /><br />( Ide Bisnis mengenai Jas Hujan transparan dengan ditambah desain yang lebih trendy agar&nbsp; pengguna lebih percaya diri ketika menggunakan jas hujan )<br /><br />Juara 3 &ldquo; WIDER &ldquo;<br /><br />&nbsp;( Ide Bisnis mengenai sepatu kesehatan di khususkan untuk struktur kaki bayi yang tidak normal dan anak kecil yang baru belajar berjalan, berbahan aluminium )<br /><br />Selamat dan Sukses Kepada Pemenang LIPO BUSINESS PLAN 2013 , Semoga kompetisi dari praktikum ini dapat di ambil hikmah dan pelajarannya sehingga kelak dapat mengimplementasikan ilmu yang di dapat pada praktikum Laboratorium Inovasi dan Pengembangan Organisasi. LIPO mengucapkan Terimakasih atas antusiasnya dari seluruh mahasiswa &ndash; mahasiswi Teknik Industri yang mengambil Praktikum Mata Kuliah Perancangan Organisasi dan Manajemen Bisnis Tahun Ajaran 2012/2013.<br /><br />Di Akhir acara Pengusaha Muda Andika Kairuliawan S.Kom mengatakan bahwa dalam menjalankan suatu usaha yang perlu adanya 3 sifat yang dimiliki dalam kelompok atau organisasi tersebut yaitu orang pertama bersifat pemimpi, orang kedua bersifat pemberi kritik, dan orang ketiga yaitu memiliki sifat jiwa implementasi sehingga ide bisnis yang ada dapat dilaksanakan tidak hanya ada dalam angan - angan.<br /><br />Praktisi Taufiq Immawan. S.T., M.M Perlu adanya jam terbang bagi tiap peserta&nbsp; LIPO Business Plan bagaimana dalam melakukan presentasi dan negoisasi untuk menarik investor atau customer.&nbsp; Intinya harus memiliki Jiwa Marketing ! pungkasnya&rdquo;.<br /><br />Kepala Prodi Teknik Industri pun menambahkan bahwa mahasiswanya harus mampu berwirausaha karena Tahun 2014 nanti akan ada persaingan Global dimana Tenaga Asing akan berebut menduduki sebuah jabatan di Negeri Indonesia yang artinya persaingan bukan hanya dari lokal daerah saja melainkan kerangkanya sudah lebih menuju persaingan Global.<br /><br />Dengan adanya apresiasi ini kedepannya Laboratorium IPO dapat menunjang kegiatan laboratorium yang lebih baik dan aktivitas Kegiatan praktikum yang dapat memberikan kebanggaan bagi Prodi Teknik Industri Universitas Islam Indonesia. Persiapkan Diri Bagi Kalian yang belum mengambil Mata Kuliah Perancangan Organisasi dan Manajemen Bisnis! Jadilah Yang Kreatif &amp; Inovatif !</p>', 28, 'Sep', 13, 0),
(61, 'PENGUMUMAN LIPO BUSINESS PLAN COMPETITION', '<p>Assalamualaikum,</p>\r\n<p>Kami Laboratorium IPO mengundang kepada 10 Besar Kelompok yang lolos LIPO BUSINESS PLAN COMPETITION untuk hadir pada Acara Penganugerahan Pemenang LIPO BUSINESS PLAN COMPETITION, Hari Jumat 19 Juli 2013 jam 15.30 di Auditorium FTI UII. Diharapkan setiap tim datang lengkap dan tepat waktu. Terimakasih</p>\r\n<p>Wassalamualaikum,</p>', 28, 'Sep', 13, 0),
(62, 'Pengumuman 10 Besar Business Plan', '<p>Berikut adalah Daftar Judul Business Plan yang lolos Tahap seleksi 10 Besar :</p>\r\n<p><strong>&nbsp;1. Tosca Fruit</strong>&nbsp;(Jas Hujan Individu Two In One Dengan Motif Navajo): Azharian Sigit,Bintang Basharah,Yoga Satrio2.&nbsp;<br /><strong>&nbsp;2. Super Gudeg</strong>&nbsp;(Gudeg Instan): Hasanudin,Mualim,Samsiadi<br /><strong>&nbsp;3. Sweet Cactus</strong>&nbsp;(Sirup Dari Sari Tanaman Kaktus): Hatta Arifin,Hendra Trianur,Cipto Tri Sutrisno<br /><strong>&nbsp;4. Batik Nusantara</strong>&nbsp;: (Perpaduan Dari Berbagai Batik Di Indonesia):&nbsp; Rhamanda,Abdurahman Fahmi,Rezka Agung<br /><strong>&nbsp;5. Mulf Bag</strong>&nbsp;(Tas Backpacker Multifungsi): Edwin Affandi, Astika Nuryani ,Ega Hasta<br /><strong>&nbsp;6. At-Tahrir</strong>&nbsp;(Alat Pengolahan Makanan Sapi): Muhammad Ulil Albab Damang Suhdi Lubis,Sugeng Pramono<br /><strong>&nbsp;7. WIDER</strong>&nbsp;(Sepatu Alumunium Untuk Bayi Dengan Kaki Abnormal): Widya Nur Hidayah,Rizki Anisa<br /><strong>&nbsp;8. Magic Broom</strong>&nbsp;(Alat untuk bersih-bersih All in One): Hanna Miratama, Anita Kusuma Wati,Amanda Amni<br /><strong>&nbsp;9. Sandal Pel</strong>&nbsp;(Sandal yang dapat digunakan untuk mengepel): Juang Abdi, Septian Rizki Aditya, Aditya Muhammad<strong>&nbsp;</strong><br /><strong>&nbsp;10. Etnik Batik</strong>&nbsp;(Tempat Buah dengan motif Batik): Yogi Wahyu Prastowo,Amby Sudiyo,Praduta Firman</p>\r\n<p>Selamat Bagi 10 Tim Praktikan POMB yang lolos seleksi 10 Besar Business Plan Lab IPO. Selanjutnya Bagi Kelompok yang lolos</p>\r\n<p>akan dilakukan tahap Presentasi pada&nbsp;<strong>Rabu 10 Juli 2013 jam 10.00 di Auditorium FTI UII</strong>&nbsp;dengan ketentuan sebagai berikut:</p>\r\n<p>1. Membawa Slide Presentasi Maksimal 10 Halaman dan menyerahkan Slide tersebut kepada Asisten 30 menit sebelum Acara dimulai.</p>\r\n<p>2. Kelompok yang Lolos diwajibkan datang 30 menit sebelum acara dimulai dengan anggota Lengkap.</p>\r\n<p>3. Alokasi Waktu tiap Kelompok 10 menit Presentasi lalu dilanjutkan 10 menit Tanya Jawab.</p>\r\n<p>4. Bagi Kelompok yang terlambat / tidak hadir maka di anggap&nbsp;<strong>gugur</strong>.</p>\r\n<p>Acara ini bersifat Terbuka, khususnya diharapkan kedatangan dari teman-teman praktikan POMB Semester Genap 2012/2013.</p>\r\n<p>&nbsp;</p>\r\n<p><a href="http://ipo.lab.uii.ac.id/admin.php"></a></p>', 28, 'Sep', 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `coment`
--

CREATE TABLE IF NOT EXISTS `coment` (
  `id_coment` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `isi` varchar(200) NOT NULL,
  `tanggal` int(11) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `tahun` int(11) NOT NULL,
  PRIMARY KEY (`id_coment`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `coment`
--

INSERT INTO `coment` (`id_coment`, `nama`, `email`, `isi`, `tanggal`, `bulan`, `tahun`) VALUES
(16, 'ipo_admin', 'ipo_admin', 'lkncs', 19, 'Mar', 13),
(22, 'Ivan Adhi Prasetya', 'vanzilz@yahoo.com', 'bisa gak...?', 19, 'Mar', 13),
(23, 'ipo_admin', 'ipo_admin', 'bisa gak ya..?', 19, 'Mar', 13),
(14, 'ipo_admin', 'ipo_admin', 'lsn', 19, 'Mar', 13),
(15, 'ipo_admin', 'ipo_admin', 'lkms', 19, 'Mar', 13),
(17, 'ipo_admin', 'ipo_admin', 'lvks', 19, 'Mar', 13),
(18, 'ipo_admin', 'ipo_admin', 'klvs', 19, 'Mar', 13),
(19, 'ipo_admin', 'ipo_admin', 'lknvs', 19, 'Mar', 13),
(20, 'ipo_admin', 'ipo_admin', 'mv cs', 19, 'Mar', 13),
(24, 'ipo_admin', 'ipo_admin', 'nananina', 19, 'Mar', 13),
(25, 'ipo_admin', 'ipo_admin', 'Egi koplak', 20, 'Mar', 13);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id_contact` int(1) NOT NULL,
  `telepon` varchar(30) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id_contact`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id_contact`, `telepon`, `alamat`, `email`) VALUES
(1, '08xxxxxxxxxxxxx', '<p>Jalan Kaliurang Km 14</p>\r\n<p>Sleman</p>\r\n<p>Yogyakarta</p>\r\n<p>Indonesia</p>', 'ipo.lab@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE IF NOT EXISTS `counter` (
  `id_counter` int(11) NOT NULL AUTO_INCREMENT,
  `nama_counter` varchar(30) NOT NULL,
  `angka` int(11) NOT NULL,
  PRIMARY KEY (`id_counter`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`id_counter`, `nama_counter`, `angka`) VALUES
(1, 'foto', 0),
(2, 'materi', 28);

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE IF NOT EXISTS `galeri` (
  `id_gambar` int(11) NOT NULL AUTO_INCREMENT,
  `judul_gambar` varchar(30) NOT NULL,
  `file_gambar` varchar(200) NOT NULL,
  PRIMARY KEY (`id_gambar`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `galeri`
--


-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE IF NOT EXISTS `guest` (
  `id_guest` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `judul_pesan` varchar(70) NOT NULL,
  `isi_pesan` varchar(300) NOT NULL,
  PRIMARY KEY (`id_guest`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `guest`
--


-- --------------------------------------------------------

--
-- Table structure for table `kategori_berita`
--

CREATE TABLE IF NOT EXISTS `kategori_berita` (
  `index` int(2) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(15) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kategori_berita`
--

INSERT INTO `kategori_berita` (`index`, `nama_kategori`) VALUES
(1, 'praktikum'),
(2, 'berita');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE IF NOT EXISTS `materi` (
  `id_materi` int(11) NOT NULL AUTO_INCREMENT,
  `judul_materi` varchar(100) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  PRIMARY KEY (`id_materi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `judul_materi`, `nama_file`) VALUES
(7, 'kjbvskb', '20curriculum.pdf'),
(5, 'Materi IPO', '18curriculum.pdf'),
(13, 'Pertemuan minggu 1', '26closer to the edge.docx');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id_profile` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `isi` mediumtext NOT NULL,
  `tanggal` int(11) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `tahun` int(11) NOT NULL,
  PRIMARY KEY (`id_profile`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id_profile`, `judul`, `isi`, `tanggal`, `bulan`, `tahun`) VALUES
(1, 'IPO LABORATORY', '<p style="text-align: left;"><span style="font-size: large;">NAMA</span><br />Laboratorium Inovasi dan Pengembangan Organisasi<br />&nbsp;<br /><span style="font-size: large;">VISI</span><br />&nbsp;<br />&ldquo;Menjadi Laboratorium soft system rujukan berskala nasional Dalam Bidang Manajemen Proyek, Perancangan dan Pengembangan Organisasi, dan Inovasi Manajemen Perspektif Syari&rsquo;ah&rdquo;<br />&nbsp;<br /><span style="font-size: large;">MISI</span><br />&nbsp;<br />1. &nbsp; &nbsp; Menyediakan pengetahuan dan keterampilan kepada mahasiswa dalam bidang Inovasi Manajemen, Desain dan Pengembangan Organisasi, dan Manajemen Proyek Perspektif Syari&rsquo;ah.<br />2. &nbsp; &nbsp; Memberikan kontribusi dalam pengembangan keilmuan sesuai dengan kompetensi inti laboratorium berskala nasional.<br />3. &nbsp; &nbsp; Aktif melakukan pendampingan profesional kepada masyarakat dalam pengaplikasian keilmuan sesuai dengan kompetensi inti LIPO.<br />&nbsp;<br /><br />&nbsp;<br /><span style="font-size: large;">KOMPETENSI INTI LABORATORIUM IPO</span><br />&nbsp;<br />1. &nbsp; &nbsp; Organisasi dan Manajemen Perspektif Syariah<br />Landasan Ideologis keilmuan Laboratorium Inovasi dan Pengembangan Organisasi:<br />a. &nbsp; &nbsp; Falsafah Kebenaran Ilmu<br />b. &nbsp; &nbsp; Organisasi dan Manajemen Sebagai Ilmu<br />c. &nbsp; &nbsp; &nbsp;Organisasi dan Manajemen Sebagai Aktivitas<br />d. &nbsp; &nbsp; Organisasi dan Manajemen Berorientasi syariah<br />e. &nbsp; &nbsp; Profesionalisme Perspektif Islam<br />&nbsp;<br />2. &nbsp; &nbsp; Perancangan dan Pengembangan Organisasi.<br />a. &nbsp; &nbsp; Perancangan Organisasi<br />Melalui proses yang sistematis dengan metode pendekatan sistem<br />Cakupan perancangan:<br />Visi, Misi, Perencanaan Stratejik, Proses Bisnis, Struktur Organisasi, Desain Tugas dan Pekerjaan, Desain Sistem Informasi Manajemen dan Budaya Organisasi.<br />Teori Perancangan:<br />1. &nbsp; &nbsp; Top down systematic organization design LIPO UII,<br />2. &nbsp; &nbsp; SWOT Pearce dan Robinson<br />3. &nbsp; &nbsp; Structure in Five Mintzberg,<br />4. &nbsp; &nbsp; 7&rsquo;S Framework McKinsey,<br />b. &nbsp; &nbsp; Sistem Pendukung Keputusan (DSS)<br />Cakupan:<br />1. &nbsp; &nbsp; Wide Concept System<br />2. &nbsp; &nbsp; Perancangan Data Flow (DFD)<br />&nbsp;<br />c. &nbsp; &nbsp; &nbsp;Pengembangan Organisasi<br />Melalui proses yang sistematis dengan metode pendekatan sistem<br />Cakupan pengembangan:<br />Rekayasa Proses Bisnis, Perubahan Budaya Organisasi, Pengukuran Kinerja Perusahaan Makro sampai dengan Mikro, Pengukuran Kuat dan Lemahnya Budaya Perusahaan/Organisasi.<br />Teori Pengembangan:<br />1. &nbsp; &nbsp; PCF dari American Productivity and Quality Center (APQC),<br />2. &nbsp; &nbsp; HR Scorecard Brian Becker,<br />3. &nbsp; &nbsp; 3 Elemen Budaya Brown dan Schein dan 8 Unsur Budaya dengan Skala Likert<br />&nbsp;<br />3. &nbsp; &nbsp; Manajemen Proyek<br />a. &nbsp; &nbsp; Analisa Biaya<br />Cakupan:<br />1. &nbsp; &nbsp; Rencana Penjualan (sales plan)<br />2. &nbsp; &nbsp; Sumber dan Metode Pembiayaan<br />3. &nbsp; &nbsp; Komponen-komponen biaya perusahaan: Biaya Investasi, Biaya Pokok Produksi, biaya Tetap, Biaya Variable dan Biaya Operasional,.<br />4. &nbsp; &nbsp; Analisa Harga Pokok Penjualan<br />b. &nbsp; &nbsp; Analisa Keuangan<br />Cakupan:<br />1. &nbsp; &nbsp; Laporan Keungan Perspektif Pemodal, Manajemen dan Masyarakat<br />2. &nbsp; &nbsp; Komponen Laporan Keuangan<br />3. &nbsp; &nbsp; Perhitungan Rasio dalam laporan keuangan<br />4. &nbsp; &nbsp; Analisa rasio dan keuangan metode Dupont<br />c. &nbsp; &nbsp; &nbsp;Analisa Kelayakan Bisnis<br />Cakupan:<br />1. &nbsp; &nbsp; Aspek Lokasi<br />2. &nbsp; &nbsp; Aspek Teknik dan Teknologi<br />3. &nbsp; &nbsp; Aspek Organisasi dan Manajemen<br />4. &nbsp; &nbsp; Aspek Keuangan<br />5. &nbsp; &nbsp; Aspek Pemasaran<br />6. &nbsp; &nbsp; Aspek Lingkungan<br />d. &nbsp; &nbsp; Rencana/Konsep Bisnis (Business Plan)<br />e. &nbsp; &nbsp; Perencanaan Dan Tata Letak Fasilitas/Pabrik (Plant Design)<br />&nbsp;<br />4. &nbsp; &nbsp; Inovasi Manajemen<br />a. &nbsp; &nbsp; Total Quality Manajemen<br />b. &nbsp; &nbsp; Organisasi Virtual<br />c. &nbsp; &nbsp; &nbsp;Business Process Reengineering<br />d. &nbsp; &nbsp; Corporate Culture Reengineering<br />e. &nbsp; &nbsp; Management Change<br />Cakupan:<br />1. &nbsp; &nbsp; Sistem Organisasi dan Manajemen<br />2. &nbsp; &nbsp; Sistem Informasi<br />3. &nbsp; &nbsp; Teknologi Informasi<br />4. &nbsp; &nbsp; Budaya Organisasi<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br /><span style="font-size: large;">LAB Resources</span><br />&nbsp;<br />Knowledge Basea. &nbsp; &nbsp; Modul-modul keilmuan dan praktikum LIPO<br />Terdiri dari modul tentang inovasi, perancangan dan pengembangan organisasi serta manajemen.<br />b. &nbsp; &nbsp; Perpustakaan Lab<br />Berisi buku-buku tentang Organisasi, Manajemen, Kewirausahaan<br />Koleksi saat ini lebih dari 50 buku<br />c. &nbsp; &nbsp; &nbsp;Lab Bank of Jounal<br />Berisi jurnal-jurnal riset internasional tentang organisasi dan manajemen<br />Koleksi saat ini lebih dari 150 jurnal<br />d. &nbsp; &nbsp; Peneliti<br />Peneliti terdiri dari mahasiswa S1 dan S2 serta Dosen-dosen Teknik Industri.<br />&nbsp;<br />Facilitiesa. &nbsp; &nbsp; Ruang Riset Yang Tenang<br />b. &nbsp; &nbsp; Ruang Diskusi Yang Nyaman<br />c. &nbsp; &nbsp; &nbsp;Komputer terakses ke Internet<br />d. &nbsp; &nbsp; Komputer khusus riset</p>', 20, 'Feb', 13);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `pass`) VALUES
(1, 'ipo', 'ipo123');
