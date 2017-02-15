<section id="main" class="column">
    <article class="module width_3_quarter">
        <header><h3>Aktifasi</h3></header>
            <div class="with-padding">
                Semua hal yang berhubungan dengan website ini diatur berdasarkan menu yang telah dibagi menjadi beberapa bagian berdasarkan kategori yang sudah tersedia.
                Menu yang dapat diatur di sini meliputi :
                <ol class="list">
                    <li>
                        <a href="<?php echo base_url()?>asisten/aktifasi/tugas">Upload Tugas</a><br/>
                        Mengaktifkan maupun menon-aktifkan menu untuk upload tugas 
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>asisten/aktifasi/modul">Modul Pertemuan</a><br/>
                        Mengaktifkan maupun menon-aktifkan modul pertemuan untuk upload tugas.
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>asisten/aktifasi/kelas">Praktikum AI</a><br/>
                        Mengaktifkan maupun menon-aktifkan pendaftaran praktikum Kecerdasan Buatan.
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>asisten/aktifasi/responsi">Responsi</a><br/>
                        Mengaktifkan maupun menon-aktifkan jadwal pendaftaran responsi praktikum Kecerdasan Buatan.
                    </li>
                </ol>
            <strong>Catatan :</strong> <span style="color:red">Untuk aktifasi modul pertemuan, harus melakukan aktifasi upload tugas terlebih dahulu.</span>
            </div>
            
        <footer></footer>
    </article>
    
    <?php echo $sidebar?>
</section>

