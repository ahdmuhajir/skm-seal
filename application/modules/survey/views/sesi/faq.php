    <section id="faq" class="faq section-bg" style="background-color: #192965;">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
		<br/>
          <h2>F.A.Q</h2>
          <p style="color:#ccc; font-size:1.2rem;">Frequently Asked Questions</p>
        </div>

        <div class="faq-list">
          <ul>
            <?php if (count($faq)>0): ?>
              <?php foreach ($faq as $faq): ?>
                <li data-aos="fade-up">
                  <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" class="collapse" href="#faq-list-<?php echo $faq->id ?>"><?php echo $faq->pertanyaan ?><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="faq-list-<?php echo $faq->id ?>" class="collapse show" data-parent=".faq-list">
                    <p>
                      <?php echo $faq->jawaban ?>
                    </p>
                  </div>
                </li>
              <?php endforeach ?>
            <?php endif ?>
            
          </ul>
        </div>

      </div>
    </section>