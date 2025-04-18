@php use App\Livewire\UrlParamType; @endphp

@section('title', 'About Us')

<div class="container mx-auto min-h-screen lg:px-4 lg:pb-8">

    <!-- Movie Details Section -->
    <div class="grid grid-cols-1 gap-20 lg:grid-cols-4">

        <!-- Main Content -->
        <div class="space-y-12 lg:col-span-3">
            <div>
                {{-- <h1 class="text-4xl font-bold tracking-tight text-white md:text-6xl horror-title blood-red">
                    About Us
                </h1> --}}

                <h1 class="pb-6 text-4xl font-bold tracking-tight text-white md:text-6xl horror-title blood-red">
                    Privacy Policy
                </h1>

                <p class="leading-relaxed text-gray-300">
                    {{-- <strong class="block text-lg text-white">Effective Date: November 1, 2024</strong> --}}
                    {{-- <br> --}}
                    <strong class="block text-lg text-white">Our Privacy Pledge</strong>
                    <br>
                    We value your privacy and are dedicated to safeguarding your personal information. This policy outlines how we manage the data you share with us, ensuring transparency and providing you control over your information. Our goal is to be clear about our data collection, usage, and protection practices.
                    <br><br>
                    This document serves as our Privacy Policy, explaining how we handle the Personal Information gathered when you use our Service. The core purpose of collecting this data is to operate and enhance the Service we provide. By using our Service, you agree to the methods described herein. Definitions for terms used in this policy can be found in our Terms and Conditions, unless otherwise specified here.
                    <br><br>
                    <strong class="block text-lg text-white">What Information We Gather</strong>
                    <br>
                    To provide our Service effectively, we might ask for specific details that can identify you personally ("Personal Information"). This information helps us contact or recognize you and may include:
                    <ul class="pl-4 my-4 list-disc list-inside">
                        <li>Your first and last name</li>
                        <li>A valid email address</li>
                    </ul>
                    <strong class="block text-lg text-white">Usage Data and Logs</strong>
                    <br>
                    Our servers automatically record information your browser sends whenever you interact with our Service ("Log Data"). This Log Data helps us understand usage patterns and may include your computer's IP address, the type and version of your browser, which pages of our Service you accessed, the date and time of your access, the duration spent on those pages, and other technical statistics.
                    <br><br>
                    <strong class="block text-lg text-white">Cookies and Advertising Technologies</strong>
                    <br>
                    We utilize cookies – small text files stored on your device – to gather information that helps us improve user experience and analyze Service traffic. Your browser settings allow you to refuse cookies or receive notifications when they are used. Please note that some parts of our Service may not function correctly if cookies are disabled.
                    <br><br>
                    Our advertising partners, such as Google, use cookies (like the DoubleClick cookie) to serve ads based on your visits to our Service and other websites. You can manage your ad preferences and opt-out of interest-based advertising through Google's Ad Settings.
                    <br><br>
                    <strong class="block text-lg text-white">Working with Third Parties</strong>
                    <br>
                    We sometimes partner with external companies and individuals ("Service Providers") for various functions, such as hosting, data analysis, or providing specific features of the Service. These partners may access your Personal Information, but only to the extent necessary to perform their tasks for us. They are contractually obligated to maintain confidentiality and not use your information for any other purpose.
                    <br><br>
                    <strong class="block text-lg text-white">Securing Your Information</strong>
                    <br>
                    We implement reasonable security practices to protect your Personal Information. However, no online transmission or electronic storage method is completely foolproof. While we strive to use effective security measures, we cannot guarantee the absolute security of your data.
                    <br><br>
                    <strong class="block text-lg text-white">Links to Other Websites</strong>
                    <br>
                    You may find links on our Service that lead to external websites not operated by us. Clicking these links will take you to the respective third-party site. We strongly encourage you to examine the privacy policy of every website you visit, as we do not control and are not responsible for the content or privacy practices of third-party sites.
                    <br><br>
                    <strong class="block text-lg text-white">Protecting Children's Privacy</strong>
                    <br>
                    Our Service is intended for a general audience and is not directed at individuals under the age of 18 ("Children"). We do not knowingly collect personal data from Children. If you, as a parent or guardian, become aware that your Child has provided us with Personal Information without your consent, please contact us. Upon verification, we will take steps to delete such information from our records.
                    <br><br>
                    <strong class="block text-lg text-white">Disclosure for Legal Reasons</strong>
                    <br>
                    We may be required to disclose your Personal Information if mandated by law, subpoena, or in response to legitimate requests from public authorities (like courts or government agencies).
                    <br><br>
                    <strong class="block text-lg text-white">Changes to This Policy</strong>
                    <br>
                    We reserve the right to modify this Privacy Policy at any time. Significant changes will be communicated by updating the policy on this page and revising the "Effective Date." We advise reviewing this page periodically to stay informed about our privacy practices.
                    <br><br>
                    <strong class="block text-lg text-white">Getting in Touch</strong>
                    <br>
                    For any questions or concerns regarding this Privacy Policy, please use our Contact Form or reach out via email.
                </p>

            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Similar Movies -->
            <div class="">
                <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">
                    Random <span class="blood-red">Movies</span>
                </h2>
                @foreach ($randomMovies as $movie)
                <x-movie.movie-block :noTagIcon="true" :movie="$movie" />
                @endforeach
            </div>
        </div>
    </div>
</div>
