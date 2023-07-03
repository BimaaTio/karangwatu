<section id="contact" class="pt-36 pb-32 bg-slate-100 dark:bg-dark">
  <div class="container" data-aos="fade-up" data-aos-duration="1000">
    <div class="w-full px-4">
      <div class="max-w-xl mx-auto text-center mb-16">
        <h4 class="font-semibold uppercase text-lg text-primary mb-2">Contact</h4>
        <h2 class="font-bold text-dark text-3xl mb-4 dark:text-white">Hubungi Kami</h2>
        <p class="font-medium text-md text-secondary">Tuliskan Pesan dibawah untuk menghubungi kami</p>
      </div>
    </div>
    <form id="myForm" onsubmit="event.preventDefault(); sendMail();">
      <div class="w-full lg:w-2/3 lg:mx-auto">
        <div class="w-full px-4 mb-8">
          <label for="name" class="text-base text-primary font-bold">Nama</label>
          <input type="text" id="name" name="name" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:ring-primary focus:ring-1 focus:border-primary" required>
        </div>
        <div class="w-full px-4 mb-8">
          <label for="email" class="text-base text-primary font-bold">Email</label>
          <input type="email" id="email" name="email" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:ring-primary focus:ring-1 focus:border-primary" required>
        </div>
        <div class="w-full px-4 mb-8">
          <label for="pesan" class="text-base text-primary font-bold">Pesan</label>
          <textarea type="text" id="pesan" name="pesan" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:ring-primary focus:ring-1 focus:border-primary h-32" required></textarea>
        </div>
        <div class="w-full px-4">
          <button type="submit" class="text-base font-semi-bold text-white bg-primary py-3 px-8 rounded-full w-full hover:opacity-80 hover:shadow-lg transition duration-500">Kirim</button>
        </div>
      </div>
    </form>
  </div>
</section>