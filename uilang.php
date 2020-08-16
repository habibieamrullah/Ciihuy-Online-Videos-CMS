<?php
    
    //Bahasa Indonesia
    function translateId(){
		global $language;
        global $rawword;
		//word definitions...
		$definitions = array(
			"About" => "Tentang",
			"You may like:" => "Mungkin Anda tertarik:",
			"Back" => "Kembali",
			"MORE" => "LIHAT",
			"More in" => "Lainnya di",
			"There is no category published." => "Belum ada kategori yang ditambahkan",
			"Base URL (make sure to include '/' symbol at the end)" => "URL Dasar (pastikan Anda tambahkan simbol '/' di akhir)",
			"Base URL" => "URL Dasar",
			"Categories" => "Kategori",
			"Category updated" => "Kategori telah diperbarui",
			"Search" => "Cari",
			"Category" => "Kategori",
			"Type something..." => "Ketik sesuatu...",
			"Content" => "Konten",
			"Date" => "Tanggal",
			"Search result for" => "Hasil pencarian kata",
			"Delete" => "Hapus",
			"Developed by" => "Dikembangkan oleh",
			"Edit Post" => "Perbarui Pos",
			"Edit" => "Ubah",
			"Nothing found" => "Tidak ditemukan apapun",
			"Enter new name for category" => "Nama kategori baru untuk",
			"Error during uploading. Try again" => "Terjadi kesalahan saatu mengunggah file. Coba lagi",
			"File is not valid. Please try again" => "File tidak valid. Coba lagi",
			"Home" => "Beranda",
			"Icon upload is OK" => "Unggah Ikon OK",
			"Image File" => "File Gambar",
			"Language" => "Bahasa",
			"Login success!" => "Login sukses!",
			"Login" => "Masuk",
			"Logo upload is OK" => "Unggah logo OK",
			"Logout" => "Keluar",
			"Main Color" => "Warna Utama",
			"New Post" => "Tambah Baru",
			"New category has been added" => "Kategori baru telah ditambahkan",
			"New category" => "Kategori baru",
			"No category has been added" => "Belum ada kategori yang sudah ditambahkan",
			"One category removed" => "Satu kategori telah dihapus",
			"Published Posts" => "Telah Terbit",
			"Recently Published" => "Baru Ditambahkan",
			"Secondary Color" => "Warna Kedua",
			"Settings updated!" => "Pengaturan telah diperbarui!",
			"Settings" => "Pengaturan",
			"Submit" => "Tambahkan",
			"There is no post published" => "Belum ada konten",
			"Title" => "Judul",
			"Uncategorized" => "Tanpa kategori",
			"Update" => "Perbarui",
			"Upload progress" => "Proses unggah",
			"Video File" => "File Video",
			"Views" => "Dilihat",
			"WELCOME!\nClick OK to start.\nIf this message appears again, please check that you have correct database connection." => "SELAMAT DATANG!\nKlik OK untuk memulai.\nJika pesan ini muncul lagi, pastikan koneksi database Anda benar.",
			"Website Icon (.ico file)" => "Ikon Situs (file .ico)",
			"Website Title" => "Judul Situs",
			"has been deleted" => "telah dihapus",
		);
		
		return proceedTranslation($definitions, $rawword);
		
    }
	
	//proceed translation
	function proceedTranslation($definitions, $rawword){
		$translation = "[untranslated]";
		$keys = array_keys($definitions); 
		for($x = 0; $x < count($keys); $x++ ) { 
			if($keys[$x] == $rawword)
				$translation = $definitions[$keys[$x]];
		}
		return $translation;
	}
    
    $rawword;
    function uilang($txt){
        global $language;
        global $rawword;
        $rawword = $txt;
        switch($language){
            case "id" :
                return translateId();
                break;
            default :
                return $txt;
                break;
        }
    }
    
    function tt($txt1, $txt2){
        global $language;
        global $rawword;
        if($rawword == $txt1){
            return $txt2;
        }
    }
    
?>