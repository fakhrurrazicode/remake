DROP TABLE tbl_base;

CREATE TABLE `tbl_base` (
  `id_base` int(5) NOT NULL AUTO_INCREMENT,
  `cabang` varchar(250) NOT NULL,
  `target` varchar(250) NOT NULL,
  `act` varchar(250) NOT NULL,
  `pcp` varchar(250) NOT NULL,
  `kurang` varchar(250) NOT NULL,
  PRIMARY KEY (`id_base`)
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=latin1;




DROP TABLE tbl_base2;

CREATE TABLE `tbl_base2` (
  `id_base2` int(5) NOT NULL AUTO_INCREMENT,
  `cabang` varchar(250) NOT NULL,
  `target` varchar(250) NOT NULL,
  `act` varchar(250) NOT NULL,
  `pcp` varchar(250) NOT NULL,
  `kurang` varchar(250) NOT NULL,
  PRIMARY KEY (`id_base2`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=latin1;




DROP TABLE tbl_ce;

CREATE TABLE `tbl_ce` (
  `id_ce` int(11) NOT NULL AUTO_INCREMENT,
  `ket` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ce`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO tbl_ce VALUES("1","Connect 5");
INSERT INTO tbl_ce VALUES("2","Connect Kurang 5");
INSERT INTO tbl_ce VALUES("3","Tidak Mau");
INSERT INTO tbl_ce VALUES("4","Tidak Terhubung");



DROP TABLE tbl_inout;

CREATE TABLE `tbl_inout` (
  `id_inout` int(5) NOT NULL AUTO_INCREMENT,
  `cin` varchar(30) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `kcu` varchar(250) NOT NULL,
  `kcp` varchar(250) NOT NULL,
  `pekerjaan` varchar(250) NOT NULL,
  `lob` varchar(250) NOT NULL,
  `flag_deb` varchar(250) NOT NULL,
  `umur` varchar(10) NOT NULL,
  `growth` int(11) NOT NULL,
  `tab` int(11) NOT NULL,
  `giro` int(11) NOT NULL,
  `auto` int(11) NOT NULL,
  `cc` int(11) NOT NULL,
  `col` int(11) NOT NULL,
  `echannel` int(11) NOT NULL,
  `invest` int(11) NOT NULL,
  `ka` int(11) NOT NULL,
  `kmk` int(11) NOT NULL,
  `mort` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `proteksi` int(11) NOT NULL,
  `pic1` varchar(250) NOT NULL,
  `pic2` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_inout`)
) ENGINE=InnoDB AUTO_INCREMENT=18053 DEFAULT CHARSET=latin1;




DROP TABLE tbl_inout2;

CREATE TABLE `tbl_inout2` (
  `id_inout2` int(5) NOT NULL AUTO_INCREMENT,
  `cin` varchar(30) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `date` varchar(30) NOT NULL,
  `kcu` varchar(250) NOT NULL,
  `kcp` varchar(250) NOT NULL,
  `bc` varchar(250) NOT NULL,
  `com` varchar(250) NOT NULL,
  `flag_deb` varchar(20) NOT NULL,
  `buka` int(11) NOT NULL,
  `deska` varchar(20) NOT NULL,
  `tutup` int(11) NOT NULL,
  `destup` varchar(20) NOT NULL,
  `col` varchar(20) NOT NULL,
  `dis` varchar(20) NOT NULL,
  `echannel` varchar(20) NOT NULL,
  `str` varchar(20) NOT NULL,
  `frx` varchar(20) NOT NULL,
  `giro` varchar(20) NOT NULL,
  `invest` varchar(20) NOT NULL,
  `kmk` varchar(20) NOT NULL,
  `ka` varchar(20) NOT NULL,
  `ks` varchar(20) NOT NULL,
  `mrch` varchar(20) NOT NULL,
  `oln` varchar(20) NOT NULL,
  `payroll` varchar(20) NOT NULL,
  `trd` varchar(20) NOT NULL,
  `valas` varchar(20) NOT NULL,
  `jml` int(11) NOT NULL,
  `growth` int(11) NOT NULL,
  `pic` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_inout2`)
) ENGINE=InnoDB AUTO_INCREMENT=22370 DEFAULT CHARSET=latin1;




DROP TABLE tbl_instansi;

CREATE TABLE `tbl_instansi` (
  `id_instansi` tinyint(1) NOT NULL,
  `institusi` varchar(150) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `kepsek` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `website` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_instansi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_instansi VALUES("1","Remake","Remake","Oke","Jl. Hasanudin","Oke","-","https://remake.com","satu@satu.com","PinClipart.com_snowboarding-clipart_5479831.png","1");



DROP TABLE tbl_k1;

CREATE TABLE `tbl_k1` (
  `id_k1` int(5) NOT NULL AUTO_INCREMENT,
  `cin` varchar(30) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `kcu` varchar(250) NOT NULL,
  `kcp` varchar(250) NOT NULL,
  `pic1` varchar(250) NOT NULL,
  `pic2` varchar(250) NOT NULL,
  `auto` int(11) NOT NULL,
  `cc` int(11) NOT NULL,
  `col` int(11) NOT NULL,
  `echannel` int(11) NOT NULL,
  `giro` int(11) NOT NULL,
  `invest` int(11) NOT NULL,
  `ka` int(11) NOT NULL,
  `kmk` int(11) NOT NULL,
  `mort` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `proteksi` int(11) NOT NULL,
  `tab` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kategori` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_k1`)
) ENGINE=InnoDB AUTO_INCREMENT=27722 DEFAULT CHARSET=latin1;

INSERT INTO tbl_k1 VALUES("27717","A","Pendidikan","Pendidikan Sekolah Menengah Kejuruan","","","","0","0","0","0","0","0","0","0","0","0","0","0","0","","0");
INSERT INTO tbl_k1 VALUES("27718","B","Sarana","Bangunan Sekolah dan Sarana Pendukung Lainnya","","","","0","0","0","0","0","0","0","0","0","0","0","0","0","","0");
INSERT INTO tbl_k1 VALUES("27719","C","Kurikulum","Kurikulum 2016","","","","0","0","0","0","0","0","0","0","0","0","0","0","0","","0");
INSERT INTO tbl_k1 VALUES("27720","D","Kegiatan","Ekstrakurikuler","","","","0","0","0","0","0","0","0","0","0","0","0","0","0","","0");
INSERT INTO tbl_k1 VALUES("27721","E","Administrasi","Administrasi Keuangan","","","","0","0","0","0","0","0","0","0","0","0","0","0","0","","0");



DROP TABLE tbl_k2;

CREATE TABLE `tbl_k2` (
  `id_k2` int(5) NOT NULL AUTO_INCREMENT,
  `cin` varchar(30) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `kcu` varchar(250) NOT NULL,
  `kcp` varchar(250) NOT NULL,
  `pic1` varchar(250) NOT NULL,
  `pic2` varchar(250) NOT NULL,
  `col` int(11) NOT NULL,
  `dis` int(11) NOT NULL,
  `echannel` int(11) NOT NULL,
  `str` int(11) NOT NULL,
  `frx` int(11) NOT NULL,
  `giro` int(11) NOT NULL,
  `invest` int(11) NOT NULL,
  `kmk` int(11) NOT NULL,
  `ka` int(11) NOT NULL,
  `ks` int(11) NOT NULL,
  `mrch` int(11) NOT NULL,
  `oln` int(11) NOT NULL,
  `payroll` int(11) NOT NULL,
  `trd` int(11) NOT NULL,
  `valas` int(11) NOT NULL,
  `jml` int(11) NOT NULL,
  `kategori` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_k2`)
) ENGINE=InnoDB AUTO_INCREMENT=21839 DEFAULT CHARSET=latin1;




DROP TABLE tbl_klasifikasi;

CREATE TABLE `tbl_klasifikasi` (
  `id_solusi` int(5) NOT NULL AUTO_INCREMENT,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `uraian` mediumtext NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_solusi`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO tbl_klasifikasi VALUES("7","KKB","Kredit Kendaraan Bermotor","KKB","1");
INSERT INTO tbl_klasifikasi VALUES("8","KPR","Kredit Pemilikan Rumah","KPR","1");
INSERT INTO tbl_klasifikasi VALUES("9","INV","Investasi","INV","1");
INSERT INTO tbl_klasifikasi VALUES("10","KA","Kredit Angsuran","KA","1");
INSERT INTO tbl_klasifikasi VALUES("11","MBCA","M-BCA","M-BCA","1");
INSERT INTO tbl_klasifikasi VALUES("12","PRO","Proteksi","Tahaka, Bancassurance","1");
INSERT INTO tbl_klasifikasi VALUES("13","COL","Collection","EDC, QRIS","1");



DROP TABLE tbl_pcp;

CREATE TABLE `tbl_pcp` (
  `id_pcp` int(10) NOT NULL AUTO_INCREMENT,
  `no_register` int(10) NOT NULL,
  `tgl_input` date NOT NULL,
  `tgl_proses` date NOT NULL,
  `nama` varchar(250) NOT NULL,
  `solusi` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `ce` varchar(50) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_pcp`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;




DROP TABLE tbl_pcp2;

CREATE TABLE `tbl_pcp2` (
  `id_pcp` int(10) NOT NULL AUTO_INCREMENT,
  `no_register` int(10) NOT NULL,
  `tgl_input` date NOT NULL,
  `tgl_proses` date NOT NULL,
  `nama` varchar(250) NOT NULL,
  `solusi` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `ce` varchar(50) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_pcp`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

INSERT INTO tbl_pcp2 VALUES("32","1","2021-12-20","2021-12-03","2","2","2","2","1");



DROP TABLE tbl_sett;

CREATE TABLE `tbl_sett` (
  `id_sett` tinyint(1) NOT NULL,
  `surat_masuk` tinyint(2) NOT NULL,
  `surat_keluar` tinyint(2) NOT NULL,
  `referensi` tinyint(2) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_sett`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_sett VALUES("1","100","10","50","82");



DROP TABLE tbl_status;

CREATE TABLE `tbl_status` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO tbl_status VALUES("1","Proses");
INSERT INTO tbl_status VALUES("2","Disburse");



DROP TABLE tbl_tahaka;

CREATE TABLE `tbl_tahaka` (
  `id_tahaka` int(5) NOT NULL AUTO_INCREMENT,
  `cin` varchar(30) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `kanwil` varchar(5) NOT NULL,
  `kcu` varchar(250) NOT NULL,
  `kcp` varchar(250) NOT NULL,
  `pekerjaan` varchar(250) NOT NULL,
  `umur` varchar(250) NOT NULL,
  `solusi` int(11) NOT NULL,
  `jt` varchar(250) NOT NULL,
  `flag_bo` varchar(250) NOT NULL,
  `cam` varchar(250) NOT NULL,
  `lob` varchar(250) NOT NULL,
  `avg` int(11) NOT NULL,
  `posisi` int(11) NOT NULL,
  `mutasi` int(11) NOT NULL,
  `pic1` varchar(250) NOT NULL,
  `pic2` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_tahaka`)
) ENGINE=InnoDB AUTO_INCREMENT=4400 DEFAULT CHARSET=latin1;




DROP TABLE tbl_tutup;

CREATE TABLE `tbl_tutup` (
  `id_tutup` int(5) NOT NULL AUTO_INCREMENT,
  `cin` varchar(30) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `kanwil` varchar(5) NOT NULL,
  `kcu` varchar(250) NOT NULL,
  `kcp` varchar(250) NOT NULL,
  `produk` varchar(250) NOT NULL,
  `jt` varchar(250) NOT NULL,
  `to_jt` varchar(250) NOT NULL,
  `solusi` int(11) NOT NULL,
  `pic1` varchar(250) NOT NULL,
  `pic2` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_tutup`)
) ENGINE=InnoDB AUTO_INCREMENT=8277 DEFAULT CHARSET=latin1;




DROP TABLE tbl_user;

CREATE TABLE `tbl_user` (
  `id_user` tinyint(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;

INSERT INTO tbl_user VALUES("1","superadmin","17c4520f6cfd1ab53d8745e84681eb49","SuperAdmin","000000","1");
INSERT INTO tbl_user VALUES("2","admin","21232f297a57a5a743894a0e4a801fc3","Admin","00000000","2");
INSERT INTO tbl_user VALUES("96","operator","4b583376b2767b923c3e1da60d10de59","Operator","-","3");



DROP TABLE tbl_valas;

CREATE TABLE `tbl_valas` (
  `id_valas` int(5) NOT NULL AUTO_INCREMENT,
  `cin` varchar(30) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `kw` varchar(250) NOT NULL,
  `kcu` varchar(250) NOT NULL,
  `kcp` varchar(250) NOT NULL,
  `segmen` varchar(250) NOT NULL,
  `pic` varchar(250) NOT NULL,
  `tlp` varchar(15) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_valas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




