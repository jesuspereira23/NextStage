
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(el => {
                if (el.isIntersecting) {
                    el.target.classList.add('visible');
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

        const header = document.getElementById('header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.style.borderBottomColor = 'rgba(255,255,255,0.06)';
                header.style.background = 'rgba(10,10,15,0.92)';
            } else {
                header.style.borderBottomColor = 'transparent';
                header.style.background = 'rgba(10,10,15,0.7)';
            }
        });


        const toggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const iconOpen = document.getElementById('icon-open');
        const iconClose = document.getElementById('icon-close');

        toggle.addEventListener('click', () => {
            const isOpen = !mobileMenu.classList.contains('hidden');
            mobileMenu.classList.toggle('hidden');
            iconOpen.classList.toggle('hidden', !isOpen);
            iconClose.classList.toggle('hidden', isOpen);
        });

        mobileMenu.querySelectorAll('a').forEach(a => {
            a.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                iconOpen.classList.remove('hidden');
                iconClose.classList.add('hidden');
            });
        });


        const mockup = document.getElementById('dashboard-mockup');
        if (mockup) {
            document.addEventListener('mousemove', (e) => {
                const cx = window.innerWidth / 2;
                const cy = window.innerHeight / 2;
                const dx = (e.clientX - cx) / cx;
                const dy = (e.clientY - cy) / cy;
                mockup.style.transform = `perspective(1000px) rotateY(${dx * 4}deg) rotateX(${-dy * 3}deg) translateZ(10px)`;
            });
            document.addEventListener('mouseleave', () => {
                mockup.style.transform = 'perspective(1000px) rotateY(0deg) rotateX(0deg) translateZ(0)';
            });
            mockup.style.transition = 'transform 0.15s ease';
        }
        
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                const target = document.querySelector(a.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });