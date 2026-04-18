// Dummy Job Data
const jobs = [
    {
        id: 1,
        title: "Senior Product Designer",
        company: "Paystack",
        location: "Lagos, Nigeria",
        type: "Full Time",
        salary: "₦800k - ₦1.2m",
        postedAt: "2 hours ago",
        isNew: true,
        logo: "figma"
    },
    {
        id: 2,
        title: "Full Stack Engineer (Node.js)",
        company: "Andela",
        location: "Remote",
        type: "Contract",
        salary: "$2k - $4k",
        postedAt: "5 hours ago",
        isNew: true,
        logo: "code"
    },
    {
        id: 3,
        title: "Marketing Operations Manager",
        company: "Moniepoint",
        location: "Lagos, Nigeria",
        type: "Full Time",
        salary: "₦500k - ₦800k",
        postedAt: "1 day ago",
        isNew: false,
        logo: "bar-chart"
    },
    {
        id: 4,
        title: "Customer Success Lead",
        company: "Flutterwave",
        location: "Abuja, Nigeria",
        type: "Full Time",
        salary: "₦400k - ₦600k",
        postedAt: "2 days ago",
        isNew: false,
        logo: "users"
    },
    {
        id: 5,
        title: "Data Analyst",
        company: "Interswitch",
        location: "Lagos, Nigeria",
        type: "Remote",
        salary: "₦600k - ₦900k",
        postedAt: "3 days ago",
        isNew: false,
        logo: "database"
    },
    {
        id: 6,
        title: "Junior Frontend Developer",
        company: "Kuda Bank",
        location: "Lagos, Nigeria",
        type: "Full Time",
        salary: "₦300k - ₦500k",
        postedAt: "4 days ago",
        isNew: false,
        logo: "layout"
    }
];

function renderJobs() {
    const container = document.getElementById('job-container');
    if (!container) return;

    container.innerHTML = jobs.map(job => `
        <div class="group bg-slate-50 border border-slate-100 p-6 rounded-2xl hover:bg-white hover:shadow-xl hover:border-primary/20 transition-all duration-300">
            <div class="flex items-start gap-4">
                <div class="w-14 h-14 bg-white rounded-xl shadow-sm flex items-center justify-center border border-slate-100 group-hover:border-primary/20 transition-all">
                    <i data-lucide="${job.logo}" class="w-7 h-7 text-primary"></i>
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-1">
                        <h3 class="text-lg font-bold text-slate-900 group-hover:text-primary transition-colors">${job.title}</h3>
                        ${job.isNew ? '<span class="bg-primary/10 text-primary text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wider">New</span>' : ''}
                    </div>
                    <p class="text-slate-600 font-medium mb-4">${job.company}</p>
                    
                    <div class="flex flex-wrap items-center gap-y-2 gap-x-4 text-sm text-slate-500">
                        <span class="flex items-center"><i data-lucide="map-pin" class="w-4 h-4 mr-1"></i> ${job.location}</span>
                        <span class="flex items-center"><i data-lucide="clock" class="w-4 h-4 mr-1"></i> ${job.type}</span>
                        <span class="flex items-center font-semibold text-slate-700"><i data-lucide="banknote" class="w-4 h-4 mr-1"></i> ${job.salary}</span>
                    </div>
                </div>
            </div>
            <div class="mt-6 pt-6 border-t border-slate-100 flex items-center justify-between">
                <span class="text-xs text-slate-400">Posted ${job.postedAt}</span>
                <button class="text-sm font-bold text-primary hover:text-primary-dark flex items-center">
                    Quick Apply <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                </button>
            </div>
        </div>
    `).join('');
    
    // Re-initialize icons for the new elements
    lucide.createIcons();
}

// Initialize Lucide Icons
lucide.createIcons();
renderJobs();

// Smooth reveal on scroll (optional enhancement)
const observerOptions = {
    threshold: 0.1
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate-fade-in');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

document.querySelectorAll('section').forEach(section => {
    // section.classList.add('opacity-0');
    // observer.observe(section);
});

// Mobile Menu Toggle
const mobileMenuBtn = document.getElementById('mobile-menu-btn');
const mobileMenu = document.getElementById('mobile-menu');
const menuIcon = mobileMenuBtn.querySelector('i');

mobileMenuBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
    
    // Toggle menu icon between menu and x
    const isHidden = mobileMenu.classList.contains('hidden');
    if (isHidden) {
        menuIcon.setAttribute('data-lucide', 'menu');
    } else {
        menuIcon.setAttribute('data-lucide', 'x');
    }
    lucide.createIcons();
});

// Navbar Scroll Effect
const navbar = document.getElementById('navbar');

window.addEventListener('scroll', () => {
    if (window.scrollY > 20) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Dropdown Interactivity for Search Bar (Demo)
document.querySelectorAll('.cursor-pointer').forEach(item => {
    item.addEventListener('click', (e) => {
        console.log('Dropdown clicked:', item.querySelector('p:last-child').textContent);
    });
});
