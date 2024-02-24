import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { IonicModule, ToastController } from '@ionic/angular';
import { PostProvider } from '../../providers/post-provider';
@Component({
 selector: 'app-tab2',
 templateUrl: 'tab2.page.html',
 styleUrls: ['tab2.page.scss']
})
export class Tab2Page implements OnInit {
 nama: string = '';
 nohp: string = '';
 askot: string = '';
 bias: string = '';
 tahungabung: string = '';
 tanggal_lahir: string = '';
 zodiak: string = '';
 fandom: string = '';
 constructor(
 private router: Router,
 public toastController: ToastController,
 private postPvdr: PostProvider,
 ) {

 }
 ngOnInit() {
 }
 async addRegister() {
 if (this.nama == '') {
 const toast = await this.toastController.create({
 message: 'Nama lengkap harus di isi',
 duration: 2000
 });
 toast.present();
 } else if (this.nohp == '') {
 const toast = await this.toastController.create({
 message: 'No HP/WA harus di isi',
 duration: 2000
 });
 toast.present();
 } else if (this.askot == '') {
 const toast = await this.toastController.create({
 message: 'Asal Kota harus di isi',
 duration: 2000
 });
 toast.present();
 } else if (this.bias == '') {
 const toast = await this.toastController.create({
  message: 'Bias harus di isi',
 duration: 2000
 });
 toast.present();
 } else if (this.tahungabung == '') {
 const toast = await this.toastController.create({
 message: 'Tahun gabung harus di isi',
 duration: 2000
 });
} else if (this.tanggal_lahir == '') {
    const toast = await this.toastController.create({
    message: 'Tanggal lahir harus di isi',
    duration: 2000
    });
} else if (this.zodiak == '') {
    const toast = await this.toastController.create({
    message: 'Zodiak harus di isi',
    duration: 2000
    });
} else if (this.fandom == '') {
    const toast = await this.toastController.create({
    message: 'Fandom harus di isi',
    duration: 2000
    });
 toast.present();
 } else {
 let body = {
 nama: this.nama,
 nohp: this.nohp,
 askot: this.askot,
 bias: this.bias,
 tahungabung: this.tahungabung,
 tanggal_lahir: this.tanggal_lahir,
 zodiak: this.zodiak,
 fandom: this.fandom,
 aksi: 'add_register'
 };
 this.postPvdr.postData(body, 'action.php').subscribe(async data => {
 var alertpesan = data.msg;
 if (data.success) {
 this.router.navigate(['/tab4']);
 const toast = await this.toastController.create({
 message: 'Selamat! Registrasi Members Sukses.',
 duration: 2000
 });
 toast.present();
 } else {
 const toast = await this.toastController.create({
 message: alertpesan,
 duration: 2000
 });
}
});
}
}
}
