@php use App\Livewire\UrlParamType; @endphp

@section('title', 'Terms and Conditions')

<div class="container mx-auto min-h-screen lg:px-4 lg:pb-8">

    <!-- Movie Details Section -->
    <div class="grid grid-cols-1 gap-20 lg:grid-cols-4">

        <!-- Main Content -->
        <div class="space-y-12 lg:col-span-3">
            <div>
                <h1 class="pb-6 text-4xl font-bold tracking-tight text-white md:text-6xl horror-title blood-red">
                    Terms & Conditions
                </h1>
                {{-- <p class="pb-8 text-sm text-gray-400">Last updated: November 1, 2024</p> --}}

                <div class="space-y-8 text-gray-300">
                    <section>
                        <h2 class="pb-2 text-xl font-bold text-white md:text-2xl">Introduction</h2>
                        <p class="leading-relaxed">
                            Welcome to {{ config('app.name', 'Horror Brains') }}! Before using our website (referred to as the "Service"), please carefully review these Terms of Use ("Terms"). By accessing or utilizing the Service, you confirm your agreement to adhere to and be bound by these Terms. These Terms are applicable to everyone who visits, uses, or accesses the Service. If you do not agree with any portion of these Terms, you should not use the Service.
                        </p>
                    </section>

                    <section>
                        <h2 class="pb-2 text-xl font-bold text-white md:text-2xl">Intellectual Property Rights</h2>
                        <p class="leading-relaxed">
                            The Service, encompassing its unique content, features, and operational capabilities, is and will remain the sole property of Horror Brains Clone and its associated licensors. All rights related to intellectual property are reserved.
                        </p>
                    </section>

                    <section>
                        <h2 class="pb-2 text-xl font-bold text-white md:text-2xl">User Obligations</h2>
                        <p class="leading-relaxed">
                            You commit to using the Service in accordance with all relevant laws and regulations. You bear full responsibility for any content you decide to upload, share, or otherwise transmit through the Service. It is prohibited to use the Service for unlawful purposes, to violate intellectual property rights, or to interfere with the Service's intended operation.
                        </p>
                    </section>

                    <section>
                        <h2 class="pb-2 text-xl font-bold text-white md:text-2xl">Third-Party Links</h2>
                        <p class="leading-relaxed">
                            Our Service might include links to external websites or services that are not owned or managed by Horror Brains Clone. We do not have authority over, nor do we accept responsibility for, the content, privacy guidelines, or practices of these third-party sites or services.
                        </p>
                        <p class="mt-4 leading-relaxed">
                            You recognize and accept that Horror Brains Clone is not accountable or liable, either directly or indirectly, for any harm or loss potentially caused by or related to the use of or reliance on content, products, or services available through such third-party websites or services. We highly recommend reading the terms and privacy policies of any third-party sites you visit.
                        </p>
                    </section>

                    <section>
                        <h2 class="pb-2 text-xl font-bold text-white md:text-2xl">Account Security</h2>
                        <p class="leading-relaxed">
                            Should any part of the Service necessitate account creation, you are tasked with safeguarding the confidentiality of your account details, including your password. You must inform us without delay about any unauthorized use of your account or any other security violation.
                        </p>
                    </section>

                    <section>
                        <h2 class="pb-2 text-xl font-bold text-white md:text-2xl">Termination of Service</h2>
                        <p class="leading-relaxed">
                            We hold the right to end or suspend your access to our Service at any time, without advance notice or liability, for any reason, particularly if you violate these Terms. Provisions of these Terms that naturally extend beyond termination (like ownership clauses, warranty disclaimers, indemnity, and liability limitations) will remain effective.
                        </p>
                    </section>

                    <section>
                        <h2 class="pb-2 text-xl font-bold text-white md:text-2xl">Limitation of Liability</h2>
                        <p class="leading-relaxed">
                            Within the maximum extent allowed by law, Horror Brains Clone, its partners, and licensors shall not be liable for any form of damages—direct, indirect, incidental, special, consequential, or punitive—or any loss of profits or revenue resulting from your use or inability to use the Service. This encompasses damages arising from errors, omissions, service interruptions, or defects.
                        </p>
                    </section>

                    <section>
                        <h2 class="pb-2 text-xl font-bold text-white md:text-2xl">Indemnification</h2>
                        <p class="leading-relaxed">
                            You consent to indemnify, defend, and hold harmless Horror Brains Clone, its affiliates, officers, agents, and employees against any claims, demands, losses, or damages (including reasonable legal fees) stemming from your use of the Service, your breach of these Terms, or your violation of any third party's intellectual property or other rights.
                        </p>
                    </section>

                    <section>
                        <h2 class="pb-2 text-xl font-bold text-white md:text-2xl">Disclaimer of Warranties</h2>
                        <p class="leading-relaxed">
                            Your engagement with the Service is solely at your own risk. The Service is offered on an "AS IS" and "AS AVAILABLE" basis, devoid of any warranties, whether express or implied. This includes, but is not limited to, implied warranties concerning merchantability, suitability for a specific purpose, non-infringement, or performance standards.
                        </p>
                    </section>

                     <section>
                        <h2 class="pb-2 text-xl font-bold text-white md:text-2xl">Privacy Assurance</h2>
                        <p class="leading-relaxed">
                            By utilizing the Service, you agree to the collection, application, and sharing of your information as detailed in our Privacy Policy. We advise you to review our Privacy Policy to comprehend our practices regarding your personal data and privacy protection.
                        </p>
                    </section>

                    <section>
                        <h2 class="pb-2 text-xl font-bold text-white md:text-2xl">Governing Law</h2>
                        <p class="leading-relaxed">
                            These Terms are interpreted and governed according to applicable laws, irrespective of conflict of law provisions. Our inability to enforce any right or provision within these Terms does not constitute a waiver of such rights. Should a court deem any provision of these Terms invalid or unenforceable, the remaining provisions will stay effective. These Terms form the complete agreement between us concerning the Service, replacing any previous agreements.
                        </p>
                    </section>

                    <section>
                        <h2 class="pb-2 text-xl font-bold text-white md:text-2xl">Dispute Resolution Process</h2>
                        <p class="leading-relaxed">
                            Any disagreements or claims related to these Terms or the use of the Service shall be settled through binding arbitration, not in court. Arbitration will follow the rules of the pertinent arbitration body and will occur at a location chosen by us. By accepting these Terms, you forfeit your right to a jury trial.
                        </p>
                    </section>

                    <section>
                        <h2 class="pb-2 text-xl font-bold text-white md:text-2xl">Severability Clause</h2>
                        <p class="leading-relaxed">
                            If a court determines any provision of these Terms to be invalid or unenforceable, the rest of the Terms will continue in full effect.
                        </p>
                    </section>

                    <section>
                        <h2 class="pb-2 text-xl font-bold text-white md:text-2xl">Modifications to Terms</h2>
                        <p class="leading-relaxed">
                            We retain the exclusive right to alter or substitute these Terms anytime. For significant modifications, we aim to provide a minimum of 30 days' notice before the new terms are implemented. Your continued use of our Service after any changes signifies your acceptance of the updated terms. If you disagree with the new terms, please cease using the Service.
                        </p>
                    </section>

                    <section>
                        <h2 class="pb-2 text-xl font-bold text-white md:text-2xl">Contact Information</h2>
                        <p class="leading-relaxed">
                            For questions or concerns about these Terms and Conditions, please contact us via email or use the Contact Form available on our website.
                        </p>
                    </section>
                </div>
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
