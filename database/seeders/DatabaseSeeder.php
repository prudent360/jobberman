<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Company;
use App\Models\JobListing;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@jobberman.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Employers & Companies
        $employer1 = User::create([
            'name' => 'Shola Abiodun',
            'email' => 'shola@paystack.com',
            'password' => Hash::make('password'),
            'role' => 'employer',
        ]);

        $paystack = Company::create([
            'user_id' => $employer1->id,
            'name' => 'Paystack',
            'description' => 'Paystack is a technology company solving payments problems for ambitious businesses in Africa.',
            'location' => 'Lagos, Nigeria',
            'industry' => 'Technology',
            'website' => 'https://paystack.com',
        ]);

        $employer2 = User::create([
            'name' => 'Ade Johnson',
            'email' => 'ade@andela.com',
            'password' => Hash::make('password'),
            'role' => 'employer',
        ]);

        $andela = Company::create([
            'user_id' => $employer2->id,
            'name' => 'Andela',
            'description' => 'Andela is a global talent marketplace connecting companies with vetted remote engineers.',
            'location' => 'Remote',
            'industry' => 'Technology',
            'website' => 'https://andela.com',
        ]);

        $employer3 = User::create([
            'name' => 'Chioma Eze',
            'email' => 'chioma@moniepoint.com',
            'password' => Hash::make('password'),
            'role' => 'employer',
        ]);

        $moniepoint = Company::create([
            'user_id' => $employer3->id,
            'name' => 'Moniepoint',
            'description' => 'Moniepoint is a leading financial technology company in Africa, enabling digital payments and banking.',
            'location' => 'Lagos, Nigeria',
            'industry' => 'FinTech',
        ]);

        $employer4 = User::create([
            'name' => 'Emeka Obi',
            'email' => 'emeka@flutterwave.com',
            'password' => Hash::make('password'),
            'role' => 'employer',
        ]);

        $flutterwave = Company::create([
            'user_id' => $employer4->id,
            'name' => 'Flutterwave',
            'description' => 'Flutterwave provides a payments infrastructure for global merchants and businesses across Africa.',
            'location' => 'Lagos, Nigeria',
            'industry' => 'FinTech',
            'website' => 'https://flutterwave.com',
        ]);

        // Job Listings (migrated from main.js)
        JobListing::create([
            'company_id' => $paystack->id,
            'title' => 'Senior Product Designer',
            'description' => "We are looking for an experienced Product Designer to join our team.\n\nResponsibilities:\n• Lead design efforts for key product features\n• Create wireframes, prototypes, and high-fidelity mockups\n• Collaborate with engineering and product teams\n• Conduct user research and usability testing\n• Define and maintain our design system\n\nRequirements:\n• 5+ years of product design experience\n• Strong portfolio demonstrating UX/UI skills\n• Proficiency in Figma and design tools\n• Experience with design systems\n• Excellent communication skills",
            'location' => 'Lagos, Nigeria',
            'type' => 'full-time',
            'salary_min' => 800000,
            'salary_max' => 1200000,
            'currency' => 'NGN',
            'industry' => 'Technology',
            'experience_level' => 'senior',
        ]);

        JobListing::create([
            'company_id' => $andela->id,
            'title' => 'Full Stack Engineer (Node.js)',
            'description' => "Join Andela as a Full Stack Engineer working with modern web technologies.\n\nResponsibilities:\n• Build and maintain scalable web applications\n• Write clean, testable code in Node.js and React\n• Design and implement RESTful APIs\n• Participate in code reviews\n• Mentor junior developers\n\nRequirements:\n• 3+ years of full stack development\n• Strong proficiency in Node.js, Express, React\n• Experience with databases (PostgreSQL, MongoDB)\n• Familiarity with cloud services (AWS/GCP)\n• Strong problem-solving skills",
            'location' => 'Remote',
            'type' => 'contract',
            'salary_min' => 2000,
            'salary_max' => 4000,
            'currency' => 'USD',
            'industry' => 'Technology',
            'experience_level' => 'mid',
        ]);

        JobListing::create([
            'company_id' => $moniepoint->id,
            'title' => 'Marketing Operations Manager',
            'description' => "We need a data-driven Marketing Operations Manager to scale our marketing efforts.\n\nResponsibilities:\n• Manage marketing technology stack\n• Build marketing automation workflows\n• Analyze campaign performance and ROI\n• Coordinate cross-functional marketing campaigns\n• Manage marketing budget and reporting\n\nRequirements:\n• 4+ years in marketing operations\n• Experience with CRM and marketing automation platforms\n• Strong analytical and reporting skills\n• Project management experience\n• Excellent stakeholder management skills",
            'location' => 'Lagos, Nigeria',
            'type' => 'full-time',
            'salary_min' => 500000,
            'salary_max' => 800000,
            'currency' => 'NGN',
            'industry' => 'FinTech',
            'experience_level' => 'mid',
            'created_at' => now()->subDay(),
        ]);

        JobListing::create([
            'company_id' => $flutterwave->id,
            'title' => 'Customer Success Lead',
            'description' => "Lead our Customer Success team, ensuring clients get the most value from our platform.\n\nResponsibilities:\n• Manage key customer accounts\n• Drive customer retention and expansion\n• Build and lead a CS team\n• Create customer success playbooks\n• Report on customer health metrics\n\nRequirements:\n• 5+ years in customer success or account management\n• Leadership experience\n• Strong relationship building skills\n• Technical aptitude for SaaS products\n• Excellent communication skills",
            'location' => 'Abuja, Nigeria',
            'type' => 'full-time',
            'salary_min' => 400000,
            'salary_max' => 600000,
            'currency' => 'NGN',
            'industry' => 'FinTech',
            'experience_level' => 'senior',
            'created_at' => now()->subDays(2),
        ]);

        JobListing::create([
            'company_id' => $paystack->id,
            'title' => 'Data Analyst',
            'description' => "We are looking for a Data Analyst to provide insights that drive business decisions.\n\nResponsibilities:\n• Analyze large datasets to identify trends\n• Create dashboards and visualizations\n• Generate regular reports for stakeholders\n• Support product and business teams with data\n• Develop data models and forecasts\n\nRequirements:\n• 2+ years of data analytics experience\n• Proficiency in SQL and Python\n• Experience with BI tools (Tableau, Power BI)\n• Strong statistical analysis skills\n• Attention to detail",
            'location' => 'Lagos, Nigeria',
            'type' => 'remote',
            'salary_min' => 600000,
            'salary_max' => 900000,
            'currency' => 'NGN',
            'industry' => 'Technology',
            'experience_level' => 'entry',
            'created_at' => now()->subDays(3),
        ]);

        JobListing::create([
            'company_id' => $andela->id,
            'title' => 'Junior Frontend Developer',
            'description' => "Great opportunity for entry-level developers to kickstart their career.\n\nResponsibilities:\n• Build responsive user interfaces with React\n• Collaborate with senior developers\n• Write and maintain unit tests\n• Participate in sprint planning\n• Learn and grow with the team\n\nRequirements:\n• Basic knowledge of HTML, CSS, JavaScript\n• Familiarity with React or similar framework\n• Willingness to learn\n• Good communication skills\n• Portfolio or GitHub projects preferred",
            'location' => 'Lagos, Nigeria',
            'type' => 'full-time',
            'salary_min' => 300000,
            'salary_max' => 500000,
            'currency' => 'NGN',
            'industry' => 'Technology',
            'experience_level' => 'entry',
            'created_at' => now()->subDays(4),
        ]);

        // Extra jobs for variety
        JobListing::create([
            'company_id' => $moniepoint->id,
            'title' => 'HR Business Partner',
            'description' => "We are looking for an HR Business Partner to support our rapidly growing team.\n\nResponsibilities:\n• Partner with business leaders on people strategy\n• Manage employee relations\n• Drive performance management processes\n• Support talent acquisition efforts\n• Implement HR policies and processes\n\nRequirements:\n• 3+ years HR experience\n• Strong knowledge of labour laws\n• Experience in tech or fintech industry\n• Excellent interpersonal skills",
            'location' => 'Lagos, Nigeria',
            'type' => 'full-time',
            'salary_min' => 400000,
            'salary_max' => 700000,
            'currency' => 'NGN',
            'industry' => 'FinTech',
            'experience_level' => 'mid',
        ]);

        JobListing::create([
            'company_id' => $flutterwave->id,
            'title' => 'DevOps Engineer',
            'description' => "Join our infrastructure team to build and maintain world-class systems.\n\nResponsibilities:\n• Manage cloud infrastructure on AWS\n• Implement CI/CD pipelines\n• Monitor system performance and reliability\n• Automate deployment processes\n• Ensure security best practices\n\nRequirements:\n• 4+ years in DevOps or SRE\n• Strong AWS experience\n• Containerization (Docker, Kubernetes)\n• Infrastructure as Code (Terraform)\n• Linux systems administration",
            'location' => 'Remote',
            'type' => 'remote',
            'salary_min' => 3000,
            'salary_max' => 5000,
            'currency' => 'USD',
            'industry' => 'Technology',
            'experience_level' => 'senior',
        ]);

        // Job Seekers
        $seeker1 = User::create([
            'name' => 'Amina Bello',
            'email' => 'amina@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'seeker',
        ]);

        $seeker2 = User::create([
            'name' => 'David Okafor',
            'email' => 'david@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'seeker',
        ]);

        $seeker3 = User::create([
            'name' => 'Funke Adeyemi',
            'email' => 'funke@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'seeker',
        ]);

        // Sample Applications
        $jobs = JobListing::all();

        Application::create([
            'job_listing_id' => $jobs[0]->id,
            'user_id' => $seeker1->id,
            'cover_letter' => 'I am excited to apply for the Senior Product Designer position. With 6 years of design experience, I believe I am a strong fit for this role.',
            'status' => 'reviewed',
        ]);

        Application::create([
            'job_listing_id' => $jobs[1]->id,
            'user_id' => $seeker2->id,
            'cover_letter' => 'I am a passionate full stack developer with experience in Node.js and React.',
            'status' => 'shortlisted',
        ]);

        Application::create([
            'job_listing_id' => $jobs[0]->id,
            'user_id' => $seeker3->id,
            'cover_letter' => 'I would love the opportunity to contribute my design skills to Paystack.',
            'status' => 'pending',
        ]);

        Application::create([
            'job_listing_id' => $jobs[2]->id,
            'user_id' => $seeker1->id,
            'cover_letter' => 'My marketing background makes me a great candidate for this role.',
            'status' => 'pending',
        ]);
    }
}
