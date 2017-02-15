<section id="main" class="column">
    <article class="module width_3_quarter">
        <header><h3>Pengaturan</h3></header>
            <div class="with-padding">
                Semua hal yang berhubungan dengan website ini diatur berdasarkan menu yang telah dibagi menjadi beberapa bagian berdasarkan kategori yang sudah tersedia. Menu yang dapat diatur di sini meliputi :
                <ol class="list">
                    <li>
                        <a href="<?php echo base_url()?>superadmin/pengaturan/jabatan">Jabatan/divisi</a><br/>
                        Mengatur jabatan atau divisi yang ada pada laboratorium.
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>superadmin/pengaturan/modul">Modul Pertemuan</a><br/>
                        Mengatur jumlah pertemuan atau modul yang digunakan untuk pengumpulan tugas.
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>superadmin/pengaturan/ta">Tahun Ajaran praktikum</a><br/>
                        Mengatur tahun ajaran yang digunakan untuk dokumentasi nilai setiap tahun ajaran praktikum.
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>superadmin/pengaturan/responsi">Responsi</a><br/>
                        Mengatur jadwal untuk responsi praktikan.
                    </li>
                </ol>
            </div>
        <footer></footer>
    </article>
    
    <?php echo $sidebar?>
</section>

