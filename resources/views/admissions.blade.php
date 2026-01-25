@extends('layouts.web.app')
@section('content')
<style>
        body {
            font-family: 'Inter', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #800000 0%, #a00000 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, #800000 0%, #1e40af 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Form Styles */
        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        .step-indicator {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            position: relative;
            z-index: 2;
        }

        .step-indicator.completed {
            background-color: #10b981;
            color: white;
        }

        .step-indicator.active {
            background-color: #800000;
            color: white;
        }

        .step-indicator.pending {
            background-color: #e5e7eb;
            color: #6b7280;
        }

        .step-line {
            height: 2px;
            background-color: #e5e7eb;
            flex: 1;
            margin: 0 10px;
            position: relative;
        }

        .step-line.completed {
            background-color: #10b981;
        }

        /* Fee Table Styles */
        .fee-table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        .fee-table th {
            background-color: #800000;
            color: white;
            font-weight: 600;
            padding: 12px;
            text-align: left;
        }

        .fee-table td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .fee-table tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .fee-table tr:hover {
            background-color: #f3f4f6;
        }

        /* Toggle Switch */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background-color: #800000;
        }

        input:checked + .toggle-slider:before {
            transform: translateX(30px);
        }

        /* Application Status */
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-processing {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .status-approved {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* Progress Bar */
        .progress-container {
            width: 100%;
            height: 8px;
            background-color: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
            margin: 20px 0;
        }

        .progress-bar {
            height: 100%;
            background-color: #800000;
            border-radius: 4px;
            width: 0%;
            animation: progressBar 2s ease-in-out forwards;
        }

        /* FAQ Accordion */
        .faq-item {
            border-bottom: 1px solid #e5e7eb;
        }

        .faq-question {
            padding: 20px 0;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .faq-answer.active {
            max-height: 500px;
            padding-bottom: 20px;
        }

        .faq-icon {
            transition: transform 0.3s ease;
        }

        .faq-item.active .faq-icon {
            transform: rotate(45deg);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .step-indicator {
                width: 32px;
                height: 32px;
                font-size: 0.875rem;
            }

            .fee-table {
                font-size: 0.875rem;
            }

            .fee-table th, .fee-table td {
                padding: 8px;
            }
        }

        /* File Upload */
        .file-upload {
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload:hover {
            border-color: #800000;
            background-color: #fef2f2;
        }

        .file-upload.dragover {
            border-color: #800000;
            background-color: #fef2f2;
        }

        .uploaded-file {
            display: flex;
            align-items: center;
            background-color: #f3f4f6;
            padding: 12px;
            border-radius: 8px;
            margin-top: 10px;
        }

        /* Print Styles */
        @media print {
            .no-print {
                display: none !important;
            }

            .print-only {
                display: block !important;
            }

            body {
                font-size: 12pt;
                color: #000;
                background: #fff;
            }

            .container {
                max-width: 100% !important;
                padding: 0 !important;
            }
        }

        .print-only {
            display: none;
        }
    </style>
</head>
    <!-- Page Header -->
    <section class="gradient-bg text-white py-20 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-40 h-40 rounded-full border-4 border-white"></div>
            <div class="absolute bottom-10 right-10 w-60 h-60 rounded-full border-4 border-white"></div>
            <div class="absolute top-1/2 left-1/4 w-20 h-20 rounded-full border-4 border-white"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center animate-fade-in">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">Admissions 2026</h1>
                <p class="text-xl max-w-3xl mx-auto text-gray-100">Join Okwang Secondary School - Excellence in Education Since 1995</p>

                <!-- Breadcrumb -->
                <div class="flex justify-center items-center mt-8 space-x-2 text-sm">
                    <a href="/" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fas fa-home mr-1"></i> Home
                    </a>
                    <span class="text-gray-300">/</span>
                    <span class="text-white font-medium">Admissions</span>
                </div>

                <!-- Application Status Badge -->
                <div class="mt-8 inline-flex items-center bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                    <i class="fas fa-circle text-green-400 mr-2 animate-pulse"></i>
                    <span>Applications Open for 2026 Academic Year</span>
                </div>
            </div>
        </div>

        <!-- Wave Divider -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="fill-current text-gray-50 w-full">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"></path>
            </svg>
        </div>
    </section>

    <!-- Quick Stats -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div class="animate-slide-up">
                    <div class="text-4xl md:text-5xl font-bold text-maroon mb-2">300</div>
                    <div class="text-gray-600">Seats Available</div>
                </div>
                <div class="animate-slide-up">
                    <div class="text-4xl md:text-5xl font-bold text-school-blue mb-2">March 2026</div>
                    <div class="text-gray-600">Application Deadline</div>
                </div>
                <div class="animate-slide-up">
                    <div class="text-4xl md:text-5xl font-bold text-purple-600 mb-2">98%</div>
                    <div class="text-gray-600">Acceptance Rate (2025)</div>
                </div>
            </div>
        </div>
    </section>



    <!-- Fees Structure -->
    <section id="fees" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Fees Structure 2026</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Transparent fee structure for the 2026 academic year (Per Term)</p>
            </div>

            <!-- Fees Tabs -->
            <div class="mb-8">
                <div class="flex flex-wrap justify-center gap-2">
                    <button class="fee-tab active px-5 py-3 rounded-lg bg-maroon text-white font-medium" data-fee="boarding">
                        Boarding Students
                    </button>
                    <button class="fee-tab px-5 py-3 rounded-lg bg-gray-200 text-gray-800 font-medium hover:bg-gray-300" data-fee="day">
                        Day Students
                    </button>
                </div>
            </div>

            <!-- Fees Tables -->
            <div class="animate-slide-up">
                <!-- Boarding Fees -->
                <div class="fee-table-container" id="boarding-fees">
                    <div class="overflow-x-auto">
                        <table class="fee-table">
                            <thead>
                                <tr>
                                    <th>Class</th>
                                    <th>Tuition Fees</th>
                                    <th>Boarding Fees</th>
                                    <th>Other Charges</th>
                                    <th>Total per Term</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Senior 1 (S1)</td>
                                    <td>UGX 450,000</td>
                                    <td>UGX 350,000</td>
                                    <td>UGX 100,000</td>
                                    <td class="font-bold text-maroon">UGX 900,000</td>
                                </tr>
                                <tr>
                                    <td>Senior 2 (S2)</td>
                                    <td>UGX 450,000</td>
                                    <td>UGX 350,000</td>
                                    <td>UGX 100,000</td>
                                    <td class="font-bold text-maroon">UGX 900,000</td>
                                </tr>
                                <tr>
                                    <td>Senior 3 (S3)</td>
                                    <td>UGX 500,000</td>
                                    <td>UGX 350,000</td>
                                    <td>UGX 100,000</td>
                                    <td class="font-bold text-maroon">UGX 950,000</td>
                                </tr>
                                <tr>
                                    <td>Senior 4 (S4)</td>
                                    <td>UGX 550,000</td>
                                    <td>UGX 350,000</td>
                                    <td>UGX 150,000</td>
                                    <td class="font-bold text-maroon">UGX 1,050,000</td>
                                </tr>
                                <tr>
                                    <td>Senior 5 (S5)</td>
                                    <td>UGX 600,000</td>
                                    <td>UGX 400,000</td>
                                    <td>UGX 200,000</td>
                                    <td class="font-bold text-maroon">UGX 1,200,000</td>
                                </tr>
                                <tr>
                                    <td>Senior 6 (S6)</td>
                                    <td>UGX 650,000</td>
                                    <td>UGX 400,000</td>
                                    <td>UGX 200,000</td>
                                    <td class="font-bold text-maroon">UGX 1,250,000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Fee Notes -->
                    <div class="mt-8 bg-white p-6 rounded-lg border border-gray-200">
                        <h4 class="text-lg font-bold text-gray-900 mb-4">Important Notes:</h4>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start">
                                <i class="fas fa-info-circle text-maroon mt-1 mr-3"></i>
                                <span>All fees are per term (3 terms per year)</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-info-circle text-maroon mt-1 mr-3"></i>
                                <span>Other charges include: Development Fund, Medical, Sports, and Laboratory Fees</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-info-circle text-maroon mt-1 mr-3"></i>
                                <span>UNEB examination fees are paid separately in S4 and S6</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-info-circle text-maroon mt-1 mr-3"></i>
                                <span>Payment plans available upon request</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Day Fees (Hidden by default) -->
                <div class="fee-table-container hidden" id="day-fees">
                    <div class="overflow-x-auto">
                        <table class="fee-table">
                            <thead>
                                <tr>
                                    <th>Class</th>
                                    <th>Tuition Fees</th>
                                    <th>Lunch Fees</th>
                                    <th>Other Charges</th>
                                    <th>Total per Term</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Senior 1 (S1)</td>
                                    <td>UGX 450,000</td>
                                    <td>UGX 150,000</td>
                                    <td>UGX 100,000</td>
                                    <td class="font-bold text-maroon">UGX 700,000</td>
                                </tr>
                                <tr>
                                    <td>Senior 2 (S2)</td>
                                    <td>UGX 450,000</td>
                                    <td>UGX 150,000</td>
                                    <td>UGX 100,000</td>
                                    <td class="font-bold text-maroon">UGX 700,000</td>
                                </tr>
                                <tr>
                                    <td>Senior 3 (S3)</td>
                                    <td>UGX 500,000</td>
                                    <td>UGX 150,000</td>
                                    <td>UGX 100,000</td>
                                    <td class="font-bold text-maroon">UGX 750,000</td>
                                </tr>
                                <tr>
                                    <td>Senior 4 (S4)</td>
                                    <td>UGX 550,000</td>
                                    <td>UGX 150,000</td>
                                    <td>UGX 150,000</td>
                                    <td class="font-bold text-maroon">UGX 850,000</td>
                                </tr>
                                <tr>
                                    <td>Senior 5 (S5)</td>
                                    <td>UGX 600,000</td>
                                    <td>UGX 150,000</td>
                                    <td>UGX 200,000</td>
                                    <td class="font-bold text-maroon">UGX 950,000</td>
                                </tr>
                                <tr>
                                    <td>Senior 6 (S6)</td>
                                    <td>UGX 650,000</td>
                                    <td>UGX 150,000</td>
                                    <td>UGX 200,000</td>
                                    <td class="font-bold text-maroon">UGX 1,000,000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            <!-- Payment Methods -->
            <div class="mt-12 bg-white p-8 rounded-xl shadow-lg animate-slide-up">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Payment Methods</h3>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center p-6 border border-gray-200 rounded-lg hover:border-maroon transition-colors">
                        <div class="h-16 w-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-mobile-alt text-green-600 text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Mobile Money</h4>
                        <p class="text-gray-600 text-sm mb-4">MTN & Airtel Money</p>
                        <div class="text-sm">
                            <button class="bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-900 transition-all duration-300">
                                <i class="fas fa-download mr-2"></i> Download Payment Codes
                            </button>
                        </div>
                    </div>

                    <div class="text-center p-6 border border-gray-200 rounded-lg hover:border-maroon transition-colors">
                        <div class="h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-university text-blue-600 text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Bank Transfer</h4>
                        <p class="text-gray-600 text-sm mb-4">Direct Bank Deposit</p>
                        <div class="text-sm">
                            <div class="font-medium">Bank: Centenary Bank</div>
                            <div class="font-medium mt-1">Account: 3100034567</div>
                            <div class="font-medium mt-1">Name: Okwang Secondary School</div>
                        </div>
                    </div>

                    <div class="text-center p-6 border border-gray-200 rounded-lg hover:border-maroon transition-colors">
                        <div class="h-16 w-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-cash-register text-purple-600 text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">School Accounts Office</h4>
                        <p class="text-gray-600 text-sm mb-4">Direct Payment at School</p>
                        <div class="text-sm">
                            <div class="font-medium">Location: Administration Block</div>
                            <div class="font-medium mt-1">Hours: 8:00 AM - 5:00 PM</div>
                            <div class="font-medium mt-1">Days: Monday - Friday</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scholarships & Financial Aid -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Scholarships & Financial Aid</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">We offer various scholarship opportunities to support talented and deserving students</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 mb-12">
                <!-- Academic Excellence Scholarship -->
                <div class="bg-gradient-to-br from-maroon to-red-800 text-white rounded-xl p-8 animate-slide-up">
                    <div class="h-16 w-16 bg-white/20 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-award text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Academic Excellence Scholarship</h3>
                    <p class="text-gray-200 mb-6">For students with outstanding academic performance in previous terms.</p>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center">
                            <i class="fas fa-check mr-3"></i>
                            <span>Division 1 in PLE</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check mr-3"></i>
                            <span>Between (50 - 75) % tuition coverage</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check mr-3"></i>
                            <span>Renewable termly</span>
                        </li>
                    </ul>
                </div>

                <!-- Sports Talent Scholarship -->
                <div class="bg-gradient-to-br from-school-blue to-blue-800 text-white rounded-xl p-8 animate-slide-up">
                    <div class="h-16 w-16 bg-white/20 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-trophy text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Sports Talent Scholarship</h3>
                    <p class="text-gray-200 mb-6">For students with exceptional sports abilities in football, athletics, or netball.</p>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center">
                            <i class="fas fa-check mr-3"></i>
                            <span>Proven sports achievements</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check mr-3"></i>
                            <span>50% tuition coverage</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check mr-3"></i>
                            <span>Represent school in competitions</span>
                        </li>
                    </ul>
                </div>

                <!-- Need-Based Financial Aid -->
                <div class="bg-gradient-to-br from-green-600 to-green-800 text-white rounded-xl p-8 animate-slide-up">
                    <div class="h-16 w-16 bg-white/20 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-hands-helping text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Need-Based Financial Aid</h3>
                    <p class="text-gray-200 mb-6">For students from financially challenged backgrounds with good academic potential.</p>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center">
                            <i class="fas fa-check mr-3"></i>
                            <span>Based on financial need assessment</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check mr-3"></i>
                            <span>Up to 100% tuition coverage</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check mr-3"></i>
                            <span>Community recommendation required</span>
                        </li>
                    </ul>

                </div>
            </div>

            <!-- Scholarship Application Info -->
            <div class="bg-gray-50 p-8 rounded-xl border border-gray-200 animate-fade-in">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">How to Apply for Scholarships</h3>
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-4">Application Requirements</h4>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-file-alt text-maroon mt-1 mr-3"></i>
                                <span>Completed scholarship application form</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-certificate text-maroon mt-1 mr-3"></i>
                                <span>Copies of academic transcripts/certificates</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-receipt text-maroon mt-1 mr-3"></i>
                                <span>Proof of income (for need-based aid)</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-user text-maroon mt-1 mr-3"></i>
                                <span>Two recommendation letters</span>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-4">Important Dates</h4>
                        <ul class="space-y-4">
                            <li class="flex items-center justify-between">
                                <span class="font-medium">Scholarship Application Opens</span>
                                <span class="text-maroon font-bold">May 1, 2024</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="font-medium">Application Deadline</span>
                                <span class="text-maroon font-bold">June 15, 2024</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="font-medium">Interviews & Assessments</span>
                                <span class="text-maroon font-bold">June 20-30, 2024</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="font-medium">Award Notification</span>
                                <span class="text-maroon font-bold">July 10, 2024</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Find answers to common questions about admissions</p>
            </div>

            <div class="max-w-3xl mx-auto animate-slide-up">
                <!-- FAQ 1 -->
                <div class="faq-item">
                    <div class="faq-question">
                        <h3 class="text-lg font-bold text-gray-900">What is the application deadline for 2024 admissions?</h3>
                        <i class="fas fa-plus faq-icon text-maroon"></i>
                    </div>
                    <div class="faq-answer">
                        <p class="text-gray-600">The application deadline for the 2024 academic year is June 30, 2024. Late applications may be considered on a case-by-case basis if seats are still available.</p>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="faq-item">
                    <div class="faq-question">
                        <h3 class="text-lg font-bold text-gray-900">What are the entry requirements for Senior 1?</h3>
                        <i class="fas fa-plus faq-icon text-maroon"></i>
                    </div>
                    <div class="faq-answer">
                        <p class="text-gray-600">For Senior 1 admission, applicants must have completed Primary 7 (P7) with at least Division 2 in the Primary Leaving Examination (PLE). They must also pass our entrance examination.</p>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="faq-item">
                    <div class="faq-question">
                        <h3 class="text-lg font-bold text-gray-900">Can I apply for both boarding and day school?</h3>
                        <i class="fas fa-plus faq-icon text-maroon"></i>
                    </div>
                    <div class="faq-answer">
                        <p class="text-gray-600">Yes, you can indicate your preference for boarding or day school in the application form. However, boarding places are limited and allocated based on availability and distance from school.</p>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="faq-item">
                    <div class="faq-question">
                        <h3 class="text-lg font-bold text-gray-900">What subjects are tested in the entrance examination?</h3>
                        <i class="fas fa-plus faq-icon text-maroon"></i>
                    </div>
                    <div class="faq-answer">
                        <p class="text-gray-600">The entrance examination tests Mathematics, English Language, and General Science. For A-Level applicants, there are additional subject-specific tests based on the chosen combination.</p>
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="faq-item">
                    <div class="faq-question">
                        <h3 class="text-lg font-bold text-gray-900">Is there an application fee and is it refundable?</h3>
                        <i class="fas fa-plus faq-icon text-maroon"></i>
                    </div>
                    <div class="faq-answer">
                        <p class="text-gray-600">Yes, there is a non-refundable application fee of UGX 50,000. This fee covers the cost of processing your application and the entrance examination.</p>
                    </div>
                </div>

                <!-- FAQ 6 -->
                <div class="faq-item">
                    <div class="faq-question">
                        <h3 class="text-lg font-bold text-gray-900">When will I know if I've been accepted?</h3>
                        <i class="fas fa-plus faq-icon text-maroon"></i>
                    </div>
                    <div class="faq-answer">
                        <p class="text-gray-600">Admission decisions are typically communicated within 2 weeks after the entrance examination. Successful applicants will receive an admission letter via email and SMS.</p>
                    </div>
                </div>
            </div>

            <!-- Still Have Questions -->
            <div class="text-center mt-12">
                <p class="text-gray-600 mb-6">Still have questions? Contact our admissions office</p>
                <a href="tel:+256772123456" class="inline-flex items-center bg-maroon text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-800 transition-all duration-300">
                    <i class="fas fa-phone-alt mr-2"></i> Call Admissions: +256 772 123 456
                </a>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 bg-gradient-to-r from-maroon to-red-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Start Your Application Today</h2>
                <p class="text-xl text-gray-200 max-w-2xl mx-auto mb-8">
                    Don't miss the opportunity to join one of the best schools in Otuke District. Applications are limited and competitive.
                </p>

                <div class="flex flex-wrap justify-center gap-4">
                    <a href="#apply" class="bg-white text-maroon px-8 py-4 rounded-lg font-bold hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <i class="fas fa-file-alt mr-2"></i> Apply Online Now
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
    <!-- JavaScript -->
    <script>
        // Mobile Menu Toggle
        document.getElementById('menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Multi-step Form Navigation
        let currentStep = 1;
        const totalSteps = 5;
        const formSteps = document.querySelectorAll('.form-step');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const submitBtn = document.getElementById('submit-btn');

        function showStep(step) {
            // Hide all steps
            formSteps.forEach(formStep => {
                formStep.classList.remove('active');
            });

            // Show current step
            document.getElementById(`step-${step}`).classList.add('active');

            // Update button states
            prevBtn.disabled = step === 1;
            nextBtn.style.display = step === totalSteps ? 'none' : 'block';
            submitBtn.style.display = step === totalSteps ? 'block' : 'none';

            // Update progress bar
            const progress = (step / totalSteps) * 100;
            document.querySelector('.progress-bar').style.setProperty('--progress-width', `${progress}%`);
            document.querySelector('.progress-bar').style.width = `${progress}%`;

            // Update progress text
            document.querySelector('.text-maroon').textContent = `${Math.round(progress)}% Complete`;

            // Update review section on last step
            if (step === totalSteps) {
                updateReviewSection();
            }
        }

        // Next button click
        nextBtn.addEventListener('click', function() {
            // Validate current step before proceeding
            if (validateStep(currentStep)) {
                if (currentStep < totalSteps) {
                    currentStep++;
                    showStep(currentStep);
                }
            }
        });

        // Previous button click
        prevBtn.addEventListener('click', function() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        });

        // Validate form step
        function validateStep(step) {
            let isValid = true;
            const currentFormStep = document.getElementById(`step-${step}`);

            // Get all required inputs in current step
            const requiredInputs = currentFormStep.querySelectorAll('[required]');

            requiredInputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('border-red-500');

                    // Add error message if not already present
                    if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('text-red-500')) {
                        const errorMsg = document.createElement('p');
                        errorMsg.className = 'text-red-500 text-sm mt-1';
                        errorMsg.textContent = 'This field is required';
                        input.parentNode.appendChild(errorMsg);
                    }
                } else {
                    input.classList.remove('border-red-500');

                    // Remove error message if present
                    if (input.nextElementSibling && input.nextElementSibling.classList.contains('text-red-500')) {
                        input.nextElementSibling.remove();
                    }

                    // Email validation
                    if (input.type === 'email' && input.value) {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(input.value)) {
                            isValid = false;
                            input.classList.add('border-red-500');

                            if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('text-red-500')) {
                                const errorMsg = document.createElement('p');
                                errorMsg.className = 'text-red-500 text-sm mt-1';
                                errorMsg.textContent = 'Please enter a valid email address';
                                input.parentNode.appendChild(errorMsg);
                            }
                        }
                    }

                    // Phone validation
                    if (input.type === 'tel' && input.value) {
                        const phoneRegex = /^\+256\d{9}$/;
                        if (!phoneRegex.test(input.value.replace(/\s/g, ''))) {
                            isValid = false;
                            input.classList.add('border-red-500');

                            if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('text-red-500')) {
                                const errorMsg = document.createElement('p');
                                errorMsg.className = 'text-red-500 text-sm mt-1';
                                errorMsg.textContent = 'Please enter a valid Ugandan phone number (+256 XXX XXX XXX)';
                                input.parentNode.appendChild(errorMsg);
                            }
                        }
                    }
                }
            });

            if (!isValid) {
                // Scroll to first error
                const firstError = currentFormStep.querySelector('.border-red-500');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }

            return isValid;
        }

        // Update review section
        function updateReviewSection() {
            // Personal Information
            const firstName = document.getElementById('first-name').value;
            const lastName = document.getElementById('last-name').value;
            document.getElementById('review-name').textContent = `${firstName} ${lastName}`;

            // Date of Birth
            const dob = document.getElementById('date-of-birth').value;
            document.getElementById('review-dob').textContent = dob || '-';

            // Class Applying For
            const classApplying = document.getElementById('class-applying').value;
            const classText = {
                's1': 'Senior 1 (S1)',
                's2': 'Senior 2 (S2)',
                's3': 'Senior 3 (S3)',
                's4': 'Senior 4 (S4)',
                's5': 'Senior 5 (S5)',
                's6': 'Senior 6 (S6)'
            };
            document.getElementById('review-class').textContent = classText[classApplying] || '-';

            // Previous School
            const previousSchool = document.getElementById('previous-school').value;
            document.getElementById('review-school').textContent = previousSchool || '-';

            // Contact Information
            const phone = document.getElementById('phone').value;
            const email = document.getElementById('email').value;
            document.getElementById('review-contact').textContent = `${phone} | ${email}`;

            // Documents
            let documents = [];
            if (document.getElementById('birth-certificate-preview').classList.contains('hidden') === false) {
                documents.push('Birth Certificate');
            }
            if (document.getElementById('report-preview').classList.contains('hidden') === false) {
                documents.push('School Report');
            }
            if (document.getElementById('photos-preview').classList.contains('hidden') === false) {
                documents.push('Passport Photos');
            }
            if (document.getElementById('additional-preview').classList.contains('hidden') === false) {
                documents.push('Additional Documents');
            }
            document.getElementById('review-documents').textContent = documents.join(', ') || 'No documents uploaded';
        }

        // Form submission
        document.getElementById('admission-form').addEventListener('submit', function(e) {
            e.preventDefault();

            // Validate all steps
            let allValid = true;
            for (let i = 1; i <= totalSteps; i++) {
                if (!validateStep(i)) {
                    allValid = false;
                    break;
                }
            }

            if (allValid) {
                // In a real application, this would send data to a server
                // For demo purposes, we'll show success message
                document.getElementById('admission-form').style.display = 'none';
                document.getElementById('success-message').classList.remove('hidden');

                // Scroll to success message
                document.getElementById('success-message').scrollIntoView({ behavior: 'smooth' });
            }
        });

        // Show/hide A-Level fields based on class selection
        document.getElementById('class-applying').addEventListener('change', function() {
            const alevelFields = document.getElementById('alevel-fields');
            if (this.value === 's5' || this.value === 's6') {
                alevelFields.style.display = 'block';
            } else {
                alevelFields.style.display = 'none';
            }
        });

        // File Upload Functionality
        const fileUploads = document.querySelectorAll('.file-upload');

        fileUploads.forEach(upload => {
            const input = upload.querySelector('input[type="file"]');
            const previewId = upload.id.replace('-upload', '-preview');
            const preview = document.getElementById(previewId);

            // Click to upload
            upload.addEventListener('click', function() {
                input.click();
            });

            // Drag and drop
            upload.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('dragover');
            });

            upload.addEventListener('dragleave', function() {
                this.classList.remove('dragover');
            });

            upload.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
                input.files = e.dataTransfer.files;
                updateFilePreview(input, preview);
            });

            // File selected
            input.addEventListener('change', function() {
                updateFilePreview(this, preview);
            });
        });

        // Remove file
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-file') || e.target.closest('.remove-file')) {
                const button = e.target.classList.contains('remove-file') ? e.target : e.target.closest('.remove-file');
                const fileType = button.getAttribute('data-file');
                const input = document.getElementById(fileType === 'birth-certificate' ? 'birth-certificate' :
                                                     fileType === 'report' ? 'school-report' :
                                                     fileType === 'photos' ? 'passport-photos' : 'additional-docs');
                const preview = document.getElementById(`${fileType}-preview`);

                input.value = '';
                preview.classList.add('hidden');
            }
        });

        function updateFilePreview(input, preview) {
            if (input.files.length > 0) {
                let totalSize = 0;
                let fileNames = [];

                Array.from(input.files).forEach(file => {
                    totalSize += file.size;
                    fileNames.push(file.name);
                });

                const sizeInMB = (totalSize / (1024 * 1024)).toFixed(2);

                // Update preview
                if (input.id === 'passport-photos') {
                    document.getElementById('photos-count').textContent = `${input.files.length} file(s) uploaded`;
                } else if (input.id === 'additional-docs') {
                    document.getElementById('additional-count').textContent = `${input.files.length} file(s) uploaded`;
                } else {
                    const nameElementId = `${input.id.replace('-', '-')}-name`;
                    document.getElementById(nameElementId).textContent = fileNames[0];
                }

                const sizeElementId = `${input.id.replace('-', '-')}-size`;
                if (document.getElementById(sizeElementId)) {
                    document.getElementById(sizeElementId).textContent = `${sizeInMB} MB`;
                }

                preview.classList.remove('hidden');
            }
        }

        // Fees Tabs
        const feeTabs = document.querySelectorAll('.fee-tab');
        const feeTables = document.querySelectorAll('.fee-table-container');

        feeTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const feeType = this.getAttribute('data-fee');

                // Update active tab
                feeTabs.forEach(t => {
                    t.classList.remove('active', 'bg-maroon', 'text-white');
                    t.classList.add('bg-gray-200', 'text-gray-800');
                });
                this.classList.add('active', 'bg-maroon', 'text-white');
                this.classList.remove('bg-gray-200', 'text-gray-800');

                // Show corresponding table
                feeTables.forEach(table => {
                    table.classList.add('hidden');
                });
                document.getElementById(`${feeType}-fees`).classList.remove('hidden');
            });
        });

        // FAQ Accordion
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            const answer = item.querySelector('.faq-answer');

            question.addEventListener('click', function() {
                // Close all other items
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                        otherItem.querySelector('.faq-answer').classList.remove('active');
                    }
                });

                // Toggle current item
                item.classList.toggle('active');
                answer.classList.toggle('active');
            });
        });

        // Print Application
        document.addEventListener('click', function(e) {
            if (e.target.closest('button') && e.target.closest('button').textContent.includes('Print')) {
                window.print();
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    e.preventDefault();
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });

                    // Close mobile menu if open
                    document.getElementById('mobile-menu').classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>
