# Product Requirements Document (PRD)

## 1. Introduction

### 1.1 Purpose
The purpose of this project is to create a modern, reliable resource for horror movie enthusiasts, providing up-to-date movie releases, reviews, and discussion opportunities.

### 1.2 Scope
The site will focus on listing the latest horror movie releases, providing movie synopses, user reviews, and discussion sections. It will feature a minimalist design optimized for mobile and will be monetized via affiliate links (Amazon, Netflix, etc.) and Google Ads (in the future).

### 1.3 Stakeholders
- **Project Owner**: Developer/Creator
- **Users**: Horror movie enthusiasts, casual viewers

---

## 2. Background and Objectives

### 2.1 Background
The site aims to provide unique reviews and discussions, offering perspectives on the horror genre that spark conversation and discovery. It addresses a gap in the availability of reliable, up-to-date horror movie information.

### 2.2 Business Objectives
- Personal project.
- Monetization through Google Ads and affiliate commissions (Amazon, Netflix, etc.).

### 2.3 Success Metrics
- The main success metric is successfully putting the site online.

---

## 3. User Requirements

### 3.1 User Personas
- **Horror Movie Enthusiasts**: Individuals who are passionate about the genre and want to stay up to date with the latest releases.
- **Casual Viewers**: Users who are looking for new horror movies to watch but may not be well-versed in the genre.

### 3.2 User Stories
- **As a user**, I want to discover new horror movie releases so I can find films to watch.
- **As a user**, I want to read reviews and synopses of movies so I can make an informed decision on whether to watch them.
- **As a user**, I want to participate in discussions about the movies I’ve watched.

### 3.3 Use Cases
- **User sees the latest releases on the homepage** and clicks to read the synopsis and opinion.
- **User reads the reviews** and participates by leaving a comment or rating the movie.
- **User can rate movies** on a 1-5 star scale.

---

## 4. Functional Requirements

### 4.1 Site Navigation
The main navigation will mirror the original Horror Brains site, excluding the "Store" page.

### 4.2 Movie Database
Each movie entry will contain:
- Title
- Movie poster
- Synopsis
- Main cast
- Location, production, and distribution information
- Availability (where to watch)
- Trailer
- Critics' reviews and more resources
Movies will be categorized by main themes and tagged by sub-genres.

### 4.3 Search and Filtering
The site will allow searching by movie name and content (e.g., genre, director).

### 4.4 User Authentication
- No user registration or login will be required initially.
- Users can comment by entering their name and email (email will not be visible).

### 4.5 Reviews and Ratings
- A 1-5 star rating system will be used for movies.
- Users cannot rate reviews yet.

### 4.6 Content Submission
- Anyone can submit new movie listings and leave comments on movie pages.

### 4.7 E-commerce Integration
- No e-commerce functionality will be integrated for now, but commission-based affiliate links to platforms like Amazon and Netflix will be used.

---

## 5. Non-Functional Requirements

### 5.1 Performance
- The site should support up to 50 concurrent users and ensure fast load times.

### 5.2 Security
- The site will follow OWASP security guidelines.
- CAPTCHA will be used to prevent spam in the comment sections.

### 5.3 Usability
- The design will focus on minimalism, providing a clean and simple interface.
- The site will be fully optimized for mobile devices.

### 5.4 Scalability
- No scaling plans for now, but the architecture should allow for easy future growth.

### 5.5 Compliance
- The site will follow the relevant privacy policies, comment policies, and terms & conditions, which will be similar to those on the original Horror Brains site.

---

## 6. Technical Requirements

### 6.1 Technology Stack
- **Backend:** PHP with the Laravel framework, utilizing Livewire for dynamic features and Filament for admin dashboards.
- **Database:** PostgreSQL.
- **Solution:** Custom-built application.

### 6.2 Hosting and Deployment
- Hosted on a personal server.
- The site will be deployed using GitHub Actions via SSH.

### 6.3 Backup and Recovery
- Regular backups should be implemented, using PostgreSQL tools like `pg_dump` for logical backups and `pg_basebackup` for physical backups.
- Backups should be stored securely, preferably with an offsite or cloud storage solution.
- A disaster recovery plan will be developed to ensure the ability to restore the site and its content.

---

## 7. Project Timeline and Milestones

### 7.1 Development Phases
- **Planning:** 1 day
- **Design:** 2 days
- **Development:** 2 days
- **Testing and Deployment:** 1 day

### 7.2 Milestones
- **Target Date:** Next Monday for the design and development of the site.

### 7.3 Dependencies
- Google Ads integration.
- Commission links (Amazon, Netflix, etc.).

---

## 8. Risk Management

### 8.1 Potential Risks
- Lack of experience with Filament might cause delays or challenges in development.
- Google Ads integration could involve tasks that are difficult to achieve, but the site can go live without it initially.

### 8.2 Mitigation Strategies
- **Filament Learning Curve:** Take time to learn and consult resources to improve Filament proficiency.
- **Google Ads:** Launch the site without Google Ads initially and incorporate it later when you're ready.
- **Don't Depend on Me:** It's important to have contingency plans for any unforeseen challenges.

---

**End of PRD**