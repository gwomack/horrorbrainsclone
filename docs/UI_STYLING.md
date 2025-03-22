# Horror Brains UI Styling Guide

## Color Palette

### Primary Colors

-   **Background**: `#000000` (Black)
-   **Text**: `#f8f8f8` (Off White)
-   **Accent**: `#b91c1c` (Blood Red)
-   **Secondary Accent**: `#2d2d2d` (Dark Gray)

### Text Colors

-   **Primary Text**: `#f8f8f8` (White)
-   **Secondary Text**: `#9ca3af` (Gray-400)
-   **Muted Text**: `#6b7280` (Gray-500)
-   **Accent Text**: `#b91c1c` (Blood Red)

### Interactive Elements

-   **Hover Background**: `#1f2937` (Gray-800)
-   **Active State**: `#b91c1c` (Blood Red)
-   **Border Color**: `#1f2937` (Gray-800)

## Typography

### Font Families

-   **Primary Font**: 'Figtree' (400, 500, 600)
-   **Horror Title Font**: 'Creepster' (cursive)
-   **Horror Text Font**: 'Special Elite' (cursive)

### Font Sizes

-   **Hero Title**: 4xl (2.25rem) / 6xl (3.75rem) on larger screens
-   **Section Headings**: 2xl (1.5rem) / 3xl (1.875rem) on larger screens
-   **Subheadings**: xl (1.25rem)
-   **Body Text**: base (1rem)
-   **Small Text**: sm (0.875rem)
-   **Extra Small Text**: xs (0.75rem)

### Title Styling Standards

#### Main Section Titles

-   **Base Classes**: `text-2xl font-bold text-white md:text-3xl`
-   **Accent**: Use `<span class="blood-red">` for emphasis
-   **Spacing**: `mb-6`
-   **Example**:

```html
<h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">
    Section <span class="blood-red">Title</span>
</h2>
```

#### Subsection Titles

-   **Base Classes**: `text-xl font-semibold text-white`
-   **Spacing**: `mb-4`
-   **Example**:

```html
<h3 class="mb-4 text-xl font-semibold text-white">Subsection Title</h3>
```

#### Page Titles

-   **Base Classes**: `text-4xl font-bold tracking-tight text-white md:text-6xl horror-title blood-red`
-   **Spacing**: Based on content context
-   **Example**:

```html
<h1
    class="text-4xl font-bold tracking-tight text-white md:text-6xl horror-title blood-red"
>
    Page Title
</h1>
```

## Layout & Spacing

### Container

-   **Max Width**: 3xl (48rem)
-   **Padding**:
    -   Horizontal: 1rem (16px)
    -   Vertical: 2rem (32px) / 5rem (80px) on larger screens

### Grid System

-   **Gap**: 2rem (32px) between sections
-   **Card Gap**: 1rem (16px)
-   **Grid Columns**:
    -   Mobile: 1 column
    -   Tablet: 2 columns
    -   Desktop: 3-4 columns

### Spacing Scale

-   **xs**: 0.5rem (8px)
-   **sm**: 0.75rem (12px)
-   **base**: 1rem (16px)
-   **md**: 1.5rem (24px)
-   **lg**: 2rem (32px)
-   **xl**: 3rem (48px)

## Components

### Movie Block

#### Base Structure

```php
@props([
    'title',
    'image',
    'rating',
    'description',
    'year',
    'genre',
    'badge' => null,
    'link' => '#'
])

<div class="bg-black movie-card">
    <div class="relative movie-card-aspect">
        @if($badge)
            <div class="absolute top-2 right-2 px-2 py-1 text-xs text-white bg-red-800">
                {{ $badge }}
            </div>
        @endif
        <div class="absolute bottom-0 left-0 p-4 w-full">
            <h3 class="mb-2 text-lg font-semibold text-white">{{ $title }}</h3>
            <div class="flex items-center mb-2">
                <div class="flex text-yellow-500">
                    <!-- Dynamic star rating -->
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $rating)
                            <i class="fas fa-star"></i>
                        @elseif($i - 0.5 <= $rating)
                            <i class="fas fa-star-half-alt"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </div>
                <span class="ml-2 text-sm text-gray-400">{{ number_format($rating, 1) }}/5</span>
            </div>
            <p class="hidden text-sm text-gray-300 lg:block">{{ $description }}</p>
            <div class="flex justify-between items-center mt-3">
                <span class="text-xs text-gray-400">{{ $year }} • {{ $genre }}</span>
                <livewire:movie-thumb-tags />
            </div>
        </div>
        <a href="/movie/1" wire:navigate>
            <img src="{{ $image }}" alt="{{ $title }}" class="object-cover w-full h-full">
        </a>
    </div>
</div>
```

#### Component Properties

-   **Required Props**:
    -   `title`: Movie title
    -   `image`: Movie poster image URL
    -   `rating`: Numeric rating value (0-5)
    -   `description`: Movie description
    -   `year`: Release year
    -   `genre`: Movie genre
-   **Optional Props**:
    -   `badge`: Optional badge text (e.g., "NEW", "TRENDING")
    -   `link`: Navigation link (defaults to '#')

#### Styling Guidelines

-   **Container**:

    -   Base: `bg-black movie-card`
    -   Aspect ratio container: `relative movie-card-aspect`
    -   Image styling: `object-cover w-full h-full`
    -   Badge (optional): `absolute top-2 right-2 px-2 py-1 text-xs text-white bg-red-800`
    -   Content container: `absolute bottom-0 left-0 p-4 w-full`

-   **Typography**:

    -   Title: `text-lg font-semibold text-white mb-2`
    -   Rating: `flex items-center mb-2` with `text-yellow-500` stars
    -   Description: `text-sm text-gray-300` (hidden on mobile, visible on lg screens)
    -   Footer: `flex justify-between items-center mt-3`
    -   Genre/Year: `text-xs text-gray-400`

-   **Interactive Elements**:
    -   Image link with `wire:navigate` for smooth transitions
    -   Dynamic star rating system
    -   Livewire integration for movie tags

#### Responsive Behavior

-   Description text is hidden on mobile screens (`hidden`) and visible on large screens (`lg:block`)
-   Maintains aspect ratio across all screen sizes
-   Full-width image coverage with `object-cover`

### Cards

-   **Background**: `#111827` (Gray-900)
-   **Border**: 1px solid `#1f2937` (Gray-800)
-   **Border Radius**: 0.5rem (8px)
-   **Hover Effect**:
    -   Transform: translateY(-5px)
    -   Box Shadow: 0 10px 15px -3px rgba(180, 0, 0, 0.3)
-   **Transition**: all 0.3s ease

### Buttons

-   **Primary Button**:
    -   Background: `#b91c1c` (Blood Red)
    -   Text: White
    -   Padding: 0.5rem 1rem
    -   Border Radius: 0.375rem (6px)
    -   Hover: Lighter shade of red
-   **Secondary Button**:
    -   Background: Transparent
    -   Border: 1px solid `#1f2937`
    -   Text: White
    -   Hover: Background `#1f2937`

### Navigation

-   **Background**: Black
-   **Border**: 1px solid `#1f2937`
-   **Link Hover**:
    -   Color: `#b91c1c`
    -   Underline animation
-   **Active State**: Blood Red

### Search Bar

-   **Background**: Black
-   **Border**: 1px solid `#374151`
-   **Focus State**:
    -   Ring: 2px solid `#b91c1c`
    -   Border: Transparent
-   **Placeholder**: Gray-500

### Movie Cards

-   **Aspect Ratio**: 2:3
-   **Image Fit**: object-cover
-   **Overlay**: Gradient from black to transparent
-   **Hover Effect**: Scale and shadow

### Tags

-   **Background**: `#1f2937`
-   **Text**: White
-   **Border Radius**: 9999px (fully rounded)
-   **Padding**: 0.25rem 0.75rem
-   **Hover**: Lighter shade of gray

## Animations & Transitions

### Hover Effects

-   **Cards**: 0.3s ease
-   **Links**: 0.3s ease
-   **Buttons**: 0.2s ease

### Transitions

-   **All Interactive Elements**: 0.3s ease
-   **Scale Transform**: 0.3s ease
-   **Color Changes**: 0.2s ease

## Responsive Design

### Breakpoints

-   **sm**: 640px
-   **md**: 768px
-   **lg**: 1024px
-   **xl**: 1280px
-   **2xl**: 1536px

### Mobile Considerations

-   **Navigation**: Hamburger menu
-   **Grid**: Single column
-   **Spacing**: Reduced padding
-   **Typography**: Slightly smaller font sizes

## Accessibility

### Focus States

-   **Outline**: 2px solid `#b91c1c`
-   **Focus Ring**: 2px solid `#b91c1c`
-   **Focus Visible**: High contrast outline

### Color Contrast

-   **Text on Background**: Minimum 4.5:1
-   **Large Text**: Minimum 3:1
-   **Interactive Elements**: Minimum 3:1

## Best Practices

1. **Consistency**

    - Use predefined color values
    - Maintain consistent spacing
    - Follow typography hierarchy

2. **Performance**

    - Optimize images
    - Use appropriate image formats
    - Implement lazy loading

3. **Accessibility**

    - Include alt text for images
    - Use semantic HTML
    - Maintain proper heading hierarchy

4. **Responsive Design**

    - Mobile-first approach
    - Test on multiple devices
    - Ensure touch targets are adequate

5. **Dark Theme Optimization**
    - Use appropriate contrast ratios
    - Avoid pure white text
    - Implement subtle gradients
