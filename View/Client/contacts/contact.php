<div class="contact-page section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="left-text">
                    <div class="section-heading">
                        <h2>🎂 Chào mừng đến với <strong>Sweet Cake</strong> – Thế giới bánh sinh nhật <span style="color: #ff69b4;">ngọt ngào</span> & <span style="color: #ffa500;">tinh tế</span>! 🎉</h2>
                    </div>
                    <p style="font-size: 16px; line-height: 1.8;">
                        Tại <strong>Sweet Cake</strong>, mỗi chiếc bánh là một <em>tác phẩm nghệ thuật</em> được tạo nên từ <strong>tình yêu</strong>, <strong>sự sáng tạo</strong> và <strong>nguyên liệu cao cấp nhất</strong>. <br><br>

                        🎀 <strong>Chuyên:</strong> Bánh sinh nhật thiết kế theo yêu cầu – Dành cho mọi lứa tuổi & phong cách: <br>
                        ✨ Dễ thương cho bé yêu <br>
                        💕 Ngọt ngào cho các cặp đôi <br>
                        🥂 Sang trọng cho tiệc sinh nhật đặc biệt

                        <br><br>
                        Với đội ngũ thợ bánh <strong>giàu kinh nghiệm & tâm huyết</strong>, chúng tôi không chỉ mang đến những chiếc bánh ngon mà còn tạo ra <span style="color: #d63384;"><strong>trải nghiệm ngọt ngào & đáng nhớ</strong></span> cho bạn trong mỗi dịp đặc biệt.
                    </p>
                    <ul style="font-size: 16px; margin-top: 20px;">
                        <li><span><strong>📍 Địa chỉ:</strong></span>
                            <br>– Cổng Ong, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, Phương Canh, Nam Từ Liêm, Hà Nội
                        </li>
                        <li><span><strong>📞 Hotline:</strong></span> +123 456 7890</li>
                        <li><span><strong>📧 Email:</strong></span> sweetcake@contact.com</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="right-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="map">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.778862226124!2d105.74417031533228!3d21.043420792491742!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454c0a2f9f4f5%3A0x636b1f46d1484f87!2zMTMgUC4gVHLhu4tuaCBWxINuIELDrCwgUGjGsMahbmcgUGjGsOG7nW5nIENhbmgsIE5hbSBU4burIExpZW0sIEjDoCBO4buZaQ!5e0!3m2!1svi!2s!4v1712814164351!5m2!1svi!2s"
                                    width="100%"
                                    height="325px"
                                    frameborder="0"
                                    style="border:0; border-radius: 23px;"
                                    allowfullscreen=""
                                    loading="lazy">
                                </iframe>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <form action="" method="post" id="contactForm">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <fieldset>
                                            <input type="text" name="fullname" placeholder="Họ và tên" autocomplete="on" required class="form-control">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6">
                                        <fieldset>
                                            <input type="text" name="phone" placeholder="Số điện thoại" autocomplete="on" required class="form-control">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <input type="email" name="email" placeholder="Email của bạn" required class="form-control">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <select name="title" class="form-control" required>
                                                <option value="" disabled selected>Chọn chủ đề liên hệ</option>
                                                <option value="Đặt bánh theo yêu cầu">Đặt bánh theo yêu cầu</option>
                                                <option value="Tư vấn thiết kế bánh">Tư vấn thiết kế bánh</option>
                                                <option value="Hỗ trợ đơn hàng">Hỗ trợ đơn hàng</option>
                                                <option value="Góp ý & phản hồi">Góp ý & phản hồi</option>
                                                <option value="Khác">Khác</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <textarea name="description" placeholder="Nội dung tin nhắn của bạn..." rows="5" class="form-control"></textarea>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 d-flex justify-content-center">
                                        <fieldset class="m-0">
                                            <?php if (isset($_SESSION['user'])): ?>
                                                <button
                                                    type="submit"
                                                    id="form-submit"
                                                    class="btn btn-warning text-white px-4 py-2 rounded-pill shadow-sm d-flex align-items-center justify-content-center"
                                                    style="min-width: 200px; font-size: 16px; font-weight: 500;">
                                                    <span style="display: inline-block; transform: translateY(1px);">✉️</span>&nbsp;Gửi tin nhắn
                                                </button>
                                            <?php else: ?>
                                                <a href="../Auth/login.php" class="btn btn-warning text-white px-4 py-2 rounded-pill shadow-sm d-flex align-items-center justify-content-center"
                                                    style="min-width: 200px; font-size: 16px; font-weight: 500; text-decoration: none;">
                                                    <span style="display: inline-block; transform: translateY(1px);">🔒</span>&nbsp;Vui lòng đăng nhập
                                                </a>
                                            <?php endif; ?>
                                        </fieldset>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');

        form.addEventListener('submit', function(e) {
            let isValid = true;
            let message = "";

            const fullName = form.fullname.value.trim();
            const phone = form.phone.value.trim();
            const email = form.email.value.trim();
            const title = form.title.value;
            const description = form.description.value.trim();

            const phoneRegex = /^[0-9]{9,11}$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (fullName === "") {
                isValid = false;
                message += "• Vui lòng nhập họ tên.\n";
            }

            if (!phoneRegex.test(phone)) {
                isValid = false;
                message += "• Số điện thoại không hợp lệ (9-11 chữ số).\n";
            }

            if (!emailRegex.test(email)) {
                isValid = false;
                message += "• Email không đúng định dạng.\n";
            }

            if (!title) {
                isValid = false;
                message += "• Vui lòng chọn chủ đề liên hệ.\n";
            }

            if (description.length < 10) {
                isValid = false;
                message += "• Nội dung tin nhắn quá ngắn (tối thiểu 10 ký tự).\n";
            }

            if (!isValid) {
                e.preventDefault();
                alert("Vui lòng kiểm tra lại:\n" + message);
            }
        });
    });
</script>


<!-- Scripts -->
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/isotope.min.js"></script>
<script src="assets/js/owl-carousel.js"></script>
<script src="assets/js/counter.js"></script>
<script src="assets/js/custom.js"></script>