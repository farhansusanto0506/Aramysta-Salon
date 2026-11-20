document.addEventListener('DOMContentLoaded', function () {
    // ==========================================
    // 1. FILTER KATEGORI & PENCARIAN PORTOFOLIO
    // ==========================================
    const filterButtons = document.querySelectorAll('.portfolio-filter-btn');
    const cards = document.querySelectorAll('.portfolio-card');
    const searchInput = document.getElementById('portfolioSearch');
    let currentCategory = 'all';

    function applyFilterAndSearch() {
        const query = (searchInput?.value || '').toLowerCase().trim();
        cards.forEach(card => {
            const category = card.getAttribute('data-category');
            const tags = card.getAttribute('data-tags') || '';
            const matchesCategory = currentCategory === 'all' || category === currentCategory;
            const matchesQuery = query === '' || tags.includes(query);
            card.classList.toggle('hidden', !(matchesCategory && matchesQuery));
        });
    }

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            filterButtons.forEach(b => {
                b.classList.remove('bg-primary-container', 'text-on-primary', 'shadow-md');
                b.classList.add('bg-surface-container-lowest', 'text-on-surface');
            });
            btn.classList.add('bg-primary-container', 'text-on-primary', 'shadow-md');
            btn.classList.remove('bg-surface-container-lowest', 'text-on-surface');
            currentCategory = btn.getAttribute('data-category');
            applyFilterAndSearch();
        });
    });

    searchInput?.addEventListener('input', applyFilterAndSearch);

    // ==========================================
    // 2. SWITCHER TAMPILAN MASONRY VS GRID
    // ==========================================
    const viewMasonryBtn = document.getElementById('viewMasonryBtn');
    const viewGridBtn = document.getElementById('viewGridBtn');

    viewGridBtn?.addEventListener('click', () => {
        viewGridBtn.classList.add('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
        viewMasonryBtn?.classList.remove('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
        cards.forEach(card => {
            card.classList.remove('lg:col-span-8');
            card.classList.add('lg:col-span-4');
        });
    });

    viewMasonryBtn?.addEventListener('click', () => {
        viewMasonryBtn.classList.add('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
        viewGridBtn?.classList.remove('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
        cards.forEach(card => {
            if (card.getAttribute('data-featured') === '1') {
                card.classList.remove('lg:col-span-4');
                card.classList.add('lg:col-span-8');
            }
        });
    });

    // ==========================================
    // 3. LIVE IMAGE PREVIEW DI HALAMAN ADMIN
    // ==========================================
    const adminImageInputs = document.querySelectorAll('input[type="file"][name="image"]');
    adminImageInputs.forEach(input => {
        input.addEventListener('change', function (e) {
            const file = e.target.files?.[0];
            if (!file) return;

            const form = input.closest('form');
            const previewImg = form?.querySelector('img');
            const previewWrap = document.getElementById('createImagePreviewWrap');

            if (previewImg) {
                previewImg.src = URL.createObjectURL(file);
            }
            if (previewWrap) {
                previewWrap.classList.remove('hidden');
                previewWrap.classList.add('flex');
            }
        });
    });

    // ==========================================
    // 4. NAVBAR SCROLLSPY & SMOOTH SCROLL
    // ==========================================
    const navLinks = document.querySelectorAll('.nav-scroll-link');
    const sections = [
        document.getElementById('portofolio-section'),
        document.getElementById('koleksi-section'),
        document.getElementById('testimoni-section'),
        document.getElementById('kontak-section')
    ].filter(Boolean);

    if (navLinks.length && sections.length) {
        const setActive = (id) => {
            navLinks.forEach(link => {
                const active = link.dataset.target === id;
                link.classList.toggle('text-primary', active);
                link.classList.toggle('font-semibold', active);
                link.classList.toggle('border-b-2', active);
                link.classList.toggle('border-secondary', active);
                link.classList.toggle('text-on-surface-variant', !active);
            });
        };

        const updateOnScroll = () => {
            const scrollPos = window.scrollY + 200;
            let currentId = sections[0].id;

            for (const sec of sections) {
                const top = sec.getBoundingClientRect().top + window.scrollY;
                if (scrollPos >= top) {
                    currentId = sec.id;
                }
            }

            if ((window.innerHeight + window.scrollY) >= document.documentElement.scrollHeight - 20) {
                currentId = sections[sections.length - 1].id;
            }

            setActive(currentId);
        };

        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                const target = document.getElementById(link.dataset.target);
                if (target) {
                    e.preventDefault();
                    setActive(link.dataset.target);
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        window.addEventListener('scroll', updateOnScroll, { passive: true });
        updateOnScroll();
    }

    // ==========================================
    // 5. RESERVASI KONTAK, CEK TANGGAL PENUH & PREVIEW WHATSAPP
    // ==========================================
    const waWrapper = document.getElementById('waBookingWrapper');
    if (waWrapper) {
        const waNumber = waWrapper.dataset.waNumber;
        let bookedSchedules = {};
        try {
            bookedSchedules = JSON.parse(waWrapper.dataset.bookedSchedules || '{}');
        } catch (err) {
            bookedSchedules = {};
        }

        const waName = document.getElementById('waName');
        const waService = document.getElementById('waService');
        const waDate = document.getElementById('waDate');
        const waHour = document.getElementById('waHour');
        const waMinute = document.getElementById('waMinute');
        const waLocation = document.getElementById('waLocation');
        const waNotes = document.getElementById('waNotes');

        const scheduleStatusBox = document.getElementById('scheduleStatusBox');
        const summaryName = document.getElementById('summaryName');
        const summaryService = document.getElementById('summaryService');
        const summarySchedule = document.getElementById('summarySchedule');
        const summaryLocation = document.getElementById('summaryLocation');
        const waMessagePreview = document.getElementById('waMessagePreview');
        const waErrorMsg = document.getElementById('waErrorMsg');
        const sendWaBtn = document.getElementById('sendWaBtn');

        let isDateBooked = false;

        const formatIndoDate = (dateStr) => {
            if (!dateStr) return '[Belum dipilih]';
            const date = new Date(dateStr + 'T00:00:00');
            return date.toLocaleDateString('id-ID', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        };

        const checkAvailability = () => {
            const selectedDate = waDate.value;
            isDateBooked = false;

            if (!selectedDate) {
                scheduleStatusBox?.classList.add('hidden');
                if (sendWaBtn) {
                    sendWaBtn.disabled = false;
                    sendWaBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
                return;
            }

            const slots = bookedSchedules[selectedDate] || [];
            scheduleStatusBox?.classList.remove('hidden');

            if (slots.length > 0) {
                isDateBooked = true;
                const slot = slots[0];
                const noteText = slot.note ? ` (${slot.note})` : '';

                if (scheduleStatusBox) {
                    scheduleStatusBox.className = 'p-4 rounded-xl border border-error/40 bg-error-container/40 text-on-error-container text-xs';
                    scheduleStatusBox.innerHTML = `
                        <div class="flex items-start gap-2 font-semibold">
                            <span class="material-symbols-outlined text-base text-error shrink-0">event_busy</span>
                            <span>Tanggal ini sudah penuh / terisi (jadwal mulai pukul ${slot.start_time} WIB${noteText}) dan tidak dapat dipesan lagi. Silakan pilih tanggal lain.</span>
                        </div>
                    `;
                }

                if (sendWaBtn) {
                    sendWaBtn.disabled = true;
                    sendWaBtn.classList.add('opacity-50', 'cursor-not-allowed');
                }
            } else {
                if (scheduleStatusBox) {
                    scheduleStatusBox.className = 'p-4 rounded-xl border border-secondary/30 bg-secondary-fixed/30 text-primary text-xs';
                    scheduleStatusBox.innerHTML = `
                        <div class="flex items-center gap-2 font-semibold">
                            <span class="material-symbols-outlined text-base text-secondary">check_circle</span>
                            <span>Tanggal ini masih tersedia untuk reservasi.</span>
                        </div>
                    `;
                }

                if (sendWaBtn) {
                    sendWaBtn.disabled = false;
                    sendWaBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            }
        };

        const buildMessage = () => {
            const nameVal = waName.value.trim() || '[Nama Klien]';
            const serviceVal = waService.value;
            const dateVal = formatIndoDate(waDate.value);
            const timeVal = `${waHour.value}:${waMinute.value} WIB`;
            const rawLocation = waLocation.value.trim();
            const locationVal = rawLocation
                ? `Kunjungan ke Alamat (${rawLocation})`
                : 'Datang langsung ke Studio Ramysta Salon';
            const notesVal = waNotes.value.trim();

            if (summaryName) summaryName.textContent = waName.value.trim() || '-';
            if (summaryService) summaryService.textContent = serviceVal;
            if (summarySchedule) {
                summarySchedule.textContent = waDate.value
                    ? `${dateVal} • ${timeVal}`
                    : 'Pilih tanggal terlebih dahulu';
            }
            if (summaryLocation) summaryLocation.textContent = locationVal;

            let message = `Halo *Ramysta Salon*, saya ingin melakukan reservasi jadwal tata rias dengan rincian berikut:\n\n` +
                `• *Nama:* ${nameVal}\n` +
                `• *Layanan:* ${serviceVal}\n` +
                `• *Tanggal:* ${dateVal}\n` +
                `• *Jam:* ${timeVal}\n` +
                `• *Lokasi:* ${locationVal}`;

            if (notesVal) {
                message += `\n• *Catatan:* ${notesVal}`;
            }

            message += `\n\nMohon informasi ketersediaan jadwalnya. Terima kasih.`;
            if (waMessagePreview) waMessagePreview.textContent = message;

            checkAvailability();
            return message;
        };

        [waName, waService, waDate, waHour, waMinute, waLocation, waNotes].forEach(el => {
            el?.addEventListener('input', () => {
                waErrorMsg?.classList.add('hidden');
                buildMessage();
            });
            el?.addEventListener('change', () => {
                waErrorMsg?.classList.add('hidden');
                buildMessage();
            });
        });

        sendWaBtn?.addEventListener('click', () => {
            if (isDateBooked) {
                if (waErrorMsg) {
                    waErrorMsg.textContent = '* Tanggal yang dipilih sudah penuh. Silakan pilih tanggal lain.';
                    waErrorMsg.classList.remove('hidden');
                }
                waDate?.focus();
                return;
            }

            if (!waName.value.trim() || !waDate.value) {
                if (waErrorMsg) {
                    waErrorMsg.textContent = '* Mohon isi Nama Lengkap dan pilih Tanggal Booking terlebih dahulu.';
                    waErrorMsg.classList.remove('hidden');
                }
                if (!waName.value.trim()) waName?.focus();
                else waDate?.focus();
                return;
            }

            const finalMessage = buildMessage();
            const waUrl = `https://wa.me/${waNumber}?text=${encodeURIComponent(finalMessage)}`;
            window.open(waUrl, '_blank', 'noopener,noreferrer');
        });

        buildMessage();
    }
});