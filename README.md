# 90Pixel-homework2
Backend 3. Hafta Ödevi
Symfony ve Doctrine kullanarak Docker üzerinde çalışacak şekilde bir Süper Lig sezonu simülasyonu yapmanız isteniyor.

İsterler
- Projenin Docker container’ları üzerinde çalışması
- Symfony ve Doctrine kullanılması
- Üye girişi gibi bir sürece gerek yok
- 18 adet takım’ı “Takım Ekle” butonuna tıklayıp açacağımız bir form sayfasında tek tek ekleyeceğiz. (daha fazla takım eklenememesi gerekiyor)
- 18 takım eklendikten sonra takımların listelendiği ana sayfada “Fikstür oluştur” butonu görünecek. Bu butona tıklayınca 34 haftalık maç programı oluşturulacak. İlk 17 haftada her bir takım tüm takımlarla sırasıyla maç yapacak şekilde kurgulanacak. Sonraki 17 haftada ise ilk 17 haftada iç sahada oynayan takımlar aynı maçları deplasmanda oynayacak şekilde eşleştirilecektir.
- Fikstür oluşturulduktan sonra fikstürü gördüğümüz sayfada her bir hafta için tek tek “Haftanın maçlarını oynat" butonu olacak. Butona basınca o haftanın maçları rasgele skor değerleri ile oynatılacak. Ve o haftanın sonuçları ile puan tablosu güncellenecektir. (yani ben 5 hafta için maçları oynattığımda 5. hafta itibari ile puan durumunu görüntüleyebilmeliyim)
- 34 hafta oynatıldıktan sonra oluşan puan tablosu ile proje son bulacak.
- Form ve sayfaları Twig templale motoru kullanarak render etmeniz gerekiyor.
- Her bir takım için takım adı girilmesi yeterlidir.
- Her bir maç için her bir takım 0-6 arası rasgele gol atabilmelidir.
- Puan tablosunda bulunmasını istenen alanlar;
    - Sıra
    - Takım adı
    - Maç sayısı
    - Galibiyet sayısı
    - Beraberlik sayısı
    - Mağlubiyet sayısı
    - Attığı gol sayısı
    - Yediği gol sayısı
    - Averaj
    - Puan
- Tasarımın hiçbir önemi yok basit Bootstrap arayüzü kullanabilirsiniz
- Formlar için Symfony Form yapısını kullanmanız gerekmektedir
