document.addEventListener('DOMContentLoaded', function () {
    // ==========================================
    // 1. KONTROL GESER CAROUSEL PORTOFOLIO
    // ==========================================
    const sliderTrack = document.getElementById('portfolioSliderTrack');
    const prevBtn = document.getElementById('portfolioPrevBtn');
    const nextBtn = document.getElementById('portfolioNextBtn');

    if (sliderTrack) {
        const getScrollStep = () => {
            const firstCard = sliderTrack.querySelector('.portfolio-card');
            return firstCard ? firstCard.offsetWidth + 24 : 340;
        };

        prevBtn?.addEventListener('click', () => {
            sliderTrack.scrollBy({ left: -getScrollStep(), behavior: 'smooth' });
        });

        nextBtn?.addEventListener('click', () => {
            sliderTrack.scrollBy({ left: getScrollStep(), behavior: 'smooth' });
        });
    }

    // ==========================================
    // 2. KONTROL GESER CAROUSEL LAYANAN
    // ==========================================
    const serviceSliderTrack = document.getElementById('serviceSliderTrack');
    const servicePrevBtn = document.getElementById('servicePrevBtn');
    const serviceNextBtn = document.getElementById('serviceNextBtn');

    if (serviceSliderTrack) {
        const getServiceScrollStep = () => {
            const firstCard = serviceSliderTrack.querySelector('.service-card');
            return firstCard ? firstCard.offsetWidth + 24 : 340;
        };

        servicePrevBtn?.addEventListener('click', () => {
            serviceSliderTrack.scrollBy({ left: -getServiceScrollStep(), behavior: 'smooth' });
        });

        serviceNextBtn?.addEventListener('click', () => {
            serviceSliderTrack.scrollBy({ left: getServiceScrollStep(), behavior: 'smooth' });
        });
    }

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

                if (window.location.hash) {
                    history.replaceState(null, '', window.location.pathname);
                }
            } else {
                e.preventDefault();
                sessionStorage.setItem('scrollTarget', targetId);
                window.location.href = '/';
            }
        });
    });

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
                if (link.classList.contains('cta-reservasi-btn') || link.classList.contains('bg-primary-container')) return;

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
    // 5. RESERVASI KONTAK, PAKET DINAMIS, CEK TANGGAL PENUH & PREVIEW WHATSAPP
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

        const PACKAGES_BY_GROUP = {
            wisuda: {
                hint: 'Paket Wisuda Aramysta MUA',
                items: [
                    'Simple Hairdo (Start 50k)',
                    'Make-up Only (Start 150k)',
                    'All in One Wisuda Package (Start 250k)',
                    'Premium Wisuda Package (Start 600k)'
                ]
            },
            pernikahan: {
                hint: 'Paket Wedding & Pengantin',
                items: [
                    'Paket Wedding Violet (2,5 Jt Nett)'
                ]
            },
            siraman: {
                hint: 'Paket Rias & Busana Siraman',
                items: [
                    'Paket Basic (800k)',
                    'Paket Lengkap (1,5jt)'
                ]
            }
        };

        const detectServiceGroup = (serviceLabel) => {
            const lower = (serviceLabel || '').toLowerCase();
            if (lower.includes('wisuda') || lower.includes('graduation')) return 'wisuda';
            if (lower.includes('pernikahan') || lower.includes('wedding') || lower.includes('pengantin')) return 'pernikahan';
            if (lower.includes('siraman')) return 'siraman';
            return null;
        };

        const waName = document.getElementById('waName');
        const waService = document.getElementById('waService');
        const waPackageContainer = document.getElementById('waPackageContainer');
        const waPackage = document.getElementById('waPackage');
        const waPackageHint = document.getElementById('waPackageHint');
        const waDate = document.getElementById('waDate');
        const waHour = document.getElementById('waHour');
        const waMinute = document.getElementById('waMinute');
        const waLocation = document.getElementById('waLocation');
        const waNotes = document.getElementById('waNotes');

        const scheduleStatusBox = document.getElementById('scheduleStatusBox');
        const summaryName = document.getElementById('summaryName');
        const summaryService = document.getElementById('summaryService');
        const summaryPackageRow = document.getElementById('summaryPackageRow');
        const summaryPackage = document.getElementById('summaryPackage');
        const summarySchedule = document.getElementById('summarySchedule');
        const summaryLocation = document.getElementById('summaryLocation');
        const waMessagePreview = document.getElementById('waMessagePreview');
        const waErrorMsg = document.getElementById('waErrorMsg');
        const sendWaBtn = document.getElementById('sendWaBtn');

        let isDateBooked = false;

        const renderPackageOptions = () => {
            if (!waPackageContainer || !waPackage) return;

            const groupKey = detectServiceGroup(waService?.value || '');
            const groupData = groupKey ? PACKAGES_BY_GROUP[groupKey] : null;

            waPackage.innerHTML = '';

            if (!groupData || !groupData.items.length) {
                waPackageContainer.classList.add('hidden');
                waPackageContainer.classList.remove('flex');
                if (summaryPackageRow) {
                    summaryPackageRow.classList.add('hidden');
                    summaryPackageRow.classList.remove('flex');
                }
                return;
            }

            groupData.items.forEach((pkg) => {
                const option = document.createElement('option');
                option.value = pkg;
                option.textContent = pkg;
                waPackage.appendChild(option);
            });

            if (waPackageHint) waPackageHint.textContent = groupData.hint || '';
            waPackageContainer.classList.remove('hidden');
            waPackageContainer.classList.add('flex');
            if (summaryPackageRow) {
                summaryPackageRow.classList.remove('hidden');
                summaryPackageRow.classList.add('flex');
            }
        };

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
                const statusText = slot.type === 'blocked' || !slot.start_time
                    ? 'Tanggal ini tidak tersedia untuk reservasi. Silakan pilih tanggal lain.'
                    : `Tanggal ini sudah penuh / terisi (jadwal mulai pukul ${slot.start_time} WIB${noteText}) dan tidak dapat dipesan lagi. Silakan pilih tanggal lain.`;

                if (scheduleStatusBox) {
                    scheduleStatusBox.className = 'p-4 rounded-xl border border-error/40 bg-error-container/40 text-on-error-container text-xs';
                    scheduleStatusBox.innerHTML = `
                        <div class="flex items-start gap-2 font-semibold">
                            <span class="material-symbols-outlined text-base text-error shrink-0">event_busy</span>
                            <span>${statusText}</span>
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
            const groupKey = detectServiceGroup(serviceVal);
            const hasPackage = Boolean(groupKey && PACKAGES_BY_GROUP[groupKey]);
            const packageVal = hasPackage ? (waPackage?.value || '') : '';
            const dateStr = waDate?.value || '';
            const dateVal = formatIndoDate(dateStr);
            const timeVal = `${waHour?.value || '08'}:${waMinute?.value || '00'} WIB`;
            const rawLocation = (waLocation?.value || '').trim();
            const locationVal = rawLocation
                ? `Kunjungan ke Alamat (${rawLocation})`
                : 'Datang langsung ke Studio Aramysta Salon';
            const notesVal = (waNotes?.value || '').trim();

            if (summaryName) summaryName.textContent = rawName || '-';
            if (summaryService) summaryService.textContent = serviceVal;
            if (summaryPackage) summaryPackage.textContent = packageVal || '-';
            if (summarySchedule) {
                summarySchedule.textContent = dateStr
                    ? `${dateVal} • ${timeVal}`
                    : 'Pilih tanggal terlebih dahulu';
            }
            if (summaryLocation) summaryLocation.textContent = locationVal;

            let message = `Halo *Aramysta Salon*, saya ingin melakukan reservasi jadwal tata rias dengan rincian berikut:\n\n` +
                `• *Nama:* ${nameVal}\n` +
                `• *Layanan:* ${serviceVal}`;

            if (hasPackage && packageVal) {
                message += `\n• *Paket:* ${packageVal}`;
            }

            message += `\n• *Tanggal:* ${dateVal}\n` +
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

        waService?.addEventListener('change', () => {
            renderPackageOptions();
            waErrorMsg?.classList.add('hidden');
            buildMessage();
        });

        [waName, waPackage, waDate, waHour, waMinute, waLocation, waNotes].forEach(el => {
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

        renderPackageOptions();
        buildMessage();
    }

    // ==========================================
    // 6. HAPUS KARYA TANPA RELOAD (POSISI SCROLL TETAP)
    // ==========================================
    document.querySelectorAll('.ajax-delete-portfolio').forEach(form => {
        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            if (!confirm('Hapus karya ini?')) return;

            const card = form.closest('.portfolio-card') || form.closest('tr') || form.closest('[data-portfolio-item]');
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                || form.querySelector('input[name="_token"]')?.value;

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: new FormData(form)
                });

                if (response.ok) {
                    if (card) {
                        card.style.transition = 'opacity 0.25s ease, transform 0.25s ease';
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.95)';
                        setTimeout(() => card.remove(), 250);
                    }
                } else {
                    form.submit();
                }
            } catch (err) {
                form.submit();
            }
        });
    });

    // ==========================================
    // SCROLL REVEAL (fade in saat turun, fade out bagian bawah saat naik)
    // ==========================================
    const revealSelectors = [
        '#portofolio-section > *',
        '#koleksi-section > *',
        '#koleksi-section + section > *',
        '#layanan-section > *',
        '#testimoni-section > div > *',
        '#kontak-section > div > *',
        'footer > div > *',
    ];
    const revealTargets = document.querySelectorAll(revealSelectors.join(','));

    if ('IntersectionObserver' in window && revealTargets.length) {
        revealTargets.forEach((el) => el.classList.add('reveal'));

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    // Masuk layar -> fade in
                    entry.target.classList.add('is-visible');
                } else if (entry.boundingClientRect.top > 0) {
                    // Keluar lewat bawah layar (saat scroll ke atas) -> fade out
                    entry.target.classList.remove('is-visible');
                }
                // Keluar lewat atas layar -> dibiarkan tetap terlihat
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        revealTargets.forEach((el) => revealObserver.observe(el));
    }
});