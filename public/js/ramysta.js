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
    // 1B. KONTROL GESER CAROUSEL PORTOFOLIO
    // ==========================================
    const sliderTrack = document.getElementById('portfolioSliderTrack');
    const prevBtn = document.getElementById('portfolioPrevBtn');
    const nextBtn = document.getElementById('portfolioNextBtn');

    if (sliderTrack) {
        const getScrollStep = () => {
            const firstVisible = Array.from(cards).find(c => !c.classList.contains('hidden'));
            return firstVisible ? firstVisible.offsetWidth + 24 : 320;
        };

        prevBtn?.addEventListener('click', () => {
            sliderTrack.scrollBy({ left: -getScrollStep(), behavior: 'smooth' });
        });

        nextBtn?.addEventListener('click', () => {
            sliderTrack.scrollBy({ left: getScrollStep(), behavior: 'smooth' });
        });

        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                sliderTrack.scrollTo({ left: 0, behavior: 'smooth' });
            });
        });

        searchInput?.addEventListener('input', () => {
            sliderTrack.scrollTo({ left: 0, behavior: 'smooth' });
        });
    }

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
    // 4. SMOOTH SCROLL TANPA HASH URL & SCROLLSPY
    // ==========================================
    const navLinks = document.querySelectorAll('.nav-scroll-link');
    const sectionIds = [
        'portofolio-section',
        'koleksi-section',
        'layanan-section',
        'testimoni-section',
        'kontak-section'
    ];

    navLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            const targetId = this.dataset.target;
            if (!targetId) return;

            const targetEl = document.getElementById(targetId);
            if (targetEl) {
                e.preventDefault();
                targetEl.scrollIntoView({ behavior: 'smooth', block: 'start' });

                // Pastikan URL tetap bersih tanpa #hash
                if (window.location.hash) {
                    history.replaceState(null, '', window.location.pathname);
                }
            } else {
                // Jika sedang di halaman admin, simpan tujuan lalu kembali ke beranda
                e.preventDefault();
                sessionStorage.setItem('scrollTarget', targetId);
                window.location.href = '/';
            }
        });
    });

    // Jalankan scroll otomatis jika baru pindah dari halaman admin
    const pendingTarget = sessionStorage.getItem('scrollTarget');
    if (pendingTarget) {
        sessionStorage.removeItem('scrollTarget');
        const targetEl = document.getElementById(pendingTarget);
        if (targetEl) {
            setTimeout(() => {
                targetEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 100);
        }
    }

    const sections = sectionIds
        .map(id => document.getElementById(id))
        .filter(Boolean);

    if (navLinks.length > 0 && sections.length > 0) {
        const updateActiveNav = () => {
            const scrollPos = window.scrollY + 140;
            let currentId = sections[0].id;

            sections.forEach(section => {
                if (scrollPos >= section.offsetTop) {
                    currentId = section.id;
                }
            });

            navLinks.forEach(link => {
                // Abaikan tombol CTA Reservasi agar stylenya tidak berubah
                if (link.classList.contains('bg-primary-container')) return;

                const isActive = link.dataset.target === currentId;
                link.classList.toggle('text-primary', isActive);
                link.classList.toggle('font-semibold', isActive);
                link.classList.toggle('border-secondary', isActive);
                link.classList.toggle('text-on-surface-variant', !isActive);
                link.classList.toggle('border-transparent', !isActive);
            });
        };

        window.addEventListener('scroll', updateActiveNav, { passive: true });
        updateActiveNav();
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
            const selectedDate = waDate?.value || '';
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
            const rawName = (waName?.value || '').trim();
            const nameVal = rawName || '[Nama Klien]';
            const serviceVal = waService?.value || 'Pengantin Couture';
            const dateStr = waDate?.value || '';
            const dateVal = formatIndoDate(dateStr);
            const timeVal = `${waHour?.value || '08'}:${waMinute?.value || '00'} WIB`;
            const rawLocation = (waLocation?.value || '').trim();
            const locationVal = rawLocation
                ? `Kunjungan ke Alamat (${rawLocation})`
                : 'Datang langsung ke Studio Ramysta Salon';
            const notesVal = (waNotes?.value || '').trim();

            if (summaryName) summaryName.textContent = rawName || '-';
            if (summaryService) summaryService.textContent = serviceVal;
            if (summarySchedule) {
                summarySchedule.textContent = dateStr
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

            if (!(waName?.value || '').trim() || !(waDate?.value || '')) {
                if (waErrorMsg) {
                    waErrorMsg.textContent = '* Mohon isi Nama Lengkap dan pilih Tanggal Booking terlebih dahulu.';
                    waErrorMsg.classList.remove('hidden');
                }
                if (!(waName?.value || '').trim()) waName?.focus();
                else waDate?.focus();
                return;
            }

            const finalMessage = buildMessage();
            const waUrl = `https://wa.me/${waNumber}?text=${encodeURIComponent(finalMessage)}`;
            window.open(waUrl, '_blank', 'noopener,noreferrer');
        });

        // Inisialisasi Kalender Flatpickr
        const disabledDates = Object.keys(bookedSchedules);
        if (typeof flatpickr !== 'undefined' && waDate) {
            flatpickr(waDate, {
                locale: 'id',
                dateFormat: 'Y-m-d',
                altInput: true,
                altFormat: 'l, j F Y',
                minDate: 'today',
                disable: disabledDates,
                onChange: function () {
                    waErrorMsg?.classList.add('hidden');
                    buildMessage();
                }
            });
        }

        buildMessage();
    }
});