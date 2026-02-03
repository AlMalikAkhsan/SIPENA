<!-- Report Images Gallery (Compatible with laporan_fotos relation) -->
@if($laporan->fotos && $laporan->fotos->count() > 0)
    <div class="card-modern">
        <!-- Photo Count Badge -->
        <div class="gallery-header">
            <div class="gallery-title">
                <svg width="20" height="20" fill="currentColor">
                    <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                </svg>
                <span>Dokumentasi Foto</span>
            </div>
            <span class="photo-count-badge">{{ $laporan->fotos->count() }} Foto</span>
        </div>

        @if($laporan->fotos->count() === 1)
            <!-- Single Photo -->
            <div class="image-container-modern">
                <img src="{{ Storage::url($laporan->fotos->first()->foto_path) }}" 
                     alt="{{ $laporan->judul }}"
                     class="report-image-modern"
                     onclick="openImageModal('{{ Storage::url($laporan->fotos->first()->foto_path) }}', 0)">
                <div class="image-overlay-modern">
                    <button class="btn-view-full" onclick="openImageModal('{{ Storage::url($laporan->fotos->first()->foto_path) }}', 0)">
                        <svg width="24" height="24" fill="currentColor">
                            <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                        </svg>
                        Lihat Foto Penuh
                    </button>
                </div>
            </div>
        @else
            <!-- Multiple Photos - Carousel -->
            <div class="gallery-carousel" id="photoCarousel">
                <!-- Main Image Display -->
                <div class="carousel-main-container">
                    <button class="carousel-nav carousel-prev" onclick="changeSlide(-1)">
                        <svg width="24" height="24" fill="currentColor">
                            <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                        </svg>
                    </button>

                    <div class="carousel-main-image">
                        @foreach($laporan->fotos as $index => $foto)
                            <div class="carousel-slide {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}">
                                <img src="{{ Storage::url($foto->foto_path) }}" 
                                     alt="{{ $laporan->judul }} - Foto {{ $index + 1 }}"
                                     class="carousel-image"
                                     onclick="openImageModal('{{ Storage::url($foto->foto_path) }}', {{ $index }})">
                                <div class="slide-overlay">
                                    <button class="btn-view-full" onclick="openImageModal('{{ Storage::url($foto->foto_path) }}', {{ $index }})">
                                        <svg width="24" height="24" fill="currentColor">
                                            <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                        </svg>
                                        Lihat Foto Penuh
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button class="carousel-nav carousel-next" onclick="changeSlide(1)">
                        <svg width="24" height="24" fill="currentColor">
                            <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                        </svg>
                    </button>

                    <!-- Slide Counter -->
                    <div class="carousel-counter">
                        <span id="currentSlide">1</span> / <span id="totalSlides">{{ $laporan->fotos->count() }}</span>
                    </div>
                </div>

                <!-- Thumbnail Gallery -->
                <div class="carousel-thumbnails">
                    @foreach($laporan->fotos as $index => $foto)
                        <div class="thumbnail-item {{ $index === 0 ? 'active' : '' }}" 
                             onclick="goToSlide({{ $index }})"
                             data-thumb="{{ $index }}">
                            <img src="{{ Storage::url($foto->foto_path) }}" 
                                 alt="Thumbnail {{ $index + 1 }}">
                            <div class="thumbnail-overlay">
                                <span class="thumbnail-number">{{ $index + 1 }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@elseif($laporan->foto)
    <!-- Fallback untuk foto lama (single photo di kolom 'foto') -->
    <div class="card-modern">
        <div class="gallery-header">
            <div class="gallery-title">
                <svg width="20" height="20" fill="currentColor">
                    <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                </svg>
                <span>Dokumentasi Foto</span>
            </div>
            <span class="photo-count-badge">1 Foto</span>
        </div>
        
        <div class="image-container-modern">
            <img src="{{ Storage::url($laporan->foto) }}" 
                 alt="{{ $laporan->judul }}"
                 class="report-image-modern"
                 onclick="openImageModal('{{ Storage::url($laporan->foto) }}', 0)">
            <div class="image-overlay-modern">
                <button class="btn-view-full" onclick="openImageModal('{{ Storage::url($laporan->foto) }}', 0)">
                    <svg width="24" height="24" fill="currentColor">
                        <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                    </svg>
                    Lihat Foto Penuh
                </button>
            </div>
        </div>
    </div>
@endif

<style>
/* =====================================
   GALLERY STYLES - MULTIPLE PHOTOS
   ===================================== */

.gallery-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2rem;
    border-bottom: 2px solid #f1f3f5;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.gallery-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.125rem;
    font-weight: 700;
    color: #1a1a1a;
}

.photo-count-badge {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}

/* Gallery Carousel */
.gallery-carousel {
    position: relative;
}

.carousel-main-container {
    position: relative;
    width: 100%;
    height: 500px;
    overflow: hidden;
}

.carousel-main-image {
    position: relative;
    width: 100%;
    height: 100%;
}

.carousel-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    visibility: hidden;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    transform: scale(0.95);
}

.carousel-slide.active {
    opacity: 1;
    visibility: visible;
    transform: scale(1);
    z-index: 1;
}

.carousel-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.carousel-slide:hover .carousel-image {
    transform: scale(1.05);
}

.slide-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding: 2rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.carousel-slide:hover .slide-overlay {
    opacity: 1;
}

/* Navigation Buttons */
.carousel-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 56px;
    height: 56px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border: none;
    border-radius: 14px;
    color: #1a1a1a;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}

.carousel-nav:hover {
    background: white;
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
}

.carousel-prev {
    left: 2rem;
}

.carousel-next {
    right: 2rem;
}

/* Slide Counter */
.carousel-counter {
    position: absolute;
    top: 2rem;
    right: 2rem;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(10px);
    color: white;
    padding: 0.75rem 1.25rem;
    border-radius: 25px;
    font-size: 0.95rem;
    font-weight: 700;
    z-index: 10;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

#currentSlide {
    color: #0d6efd;
    font-size: 1.125rem;
}

/* Thumbnails */
.carousel-thumbnails {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 1rem;
    padding: 1.5rem 2rem;
    background: #f8f9fa;
    overflow-x: auto;
}

.thumbnail-item {
    position: relative;
    width: 100%;
    aspect-ratio: 16/10;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.thumbnail-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.thumbnail-item.active {
    border-color: #0d6efd;
    box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.2);
}

.thumbnail-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.thumbnail-item:hover img {
    transform: scale(1.1);
}

.thumbnail-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.7) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.thumbnail-item:hover .thumbnail-overlay,
.thumbnail-item.active .thumbnail-overlay {
    opacity: 1;
}

.thumbnail-number {
    color: white;
    font-size: 1.25rem;
    font-weight: 700;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

/* Responsive */
@media (max-width: 768px) {
    .carousel-main-container {
        height: 350px;
    }

    .carousel-nav {
        width: 44px;
        height: 44px;
    }

    .carousel-prev {
        left: 1rem;
    }

    .carousel-next {
        right: 1rem;
    }

    .carousel-counter {
        top: 1rem;
        right: 1rem;
        padding: 0.625rem 1rem;
        font-size: 0.875rem;
    }

    .carousel-thumbnails {
        grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
        gap: 0.75rem;
        padding: 1rem;
    }

    .gallery-header {
        padding: 1rem 1.25rem;
    }
}

@media (max-width: 576px) {
    .carousel-main-container {
        height: 280px;
    }

    .carousel-thumbnails {
        grid-template-columns: repeat(auto-fill, minmax(70px, 1fr));
        gap: 0.5rem;
        padding: 0.75rem;
    }

    .gallery-title {
        font-size: 1rem;
    }

    .photo-count-badge {
        padding: 0.375rem 0.75rem;
        font-size: 0.8rem;
    }
}
</style>

<script>
// Carousel functionality
let currentSlideIndex = 0;
const slides = document.querySelectorAll('.carousel-slide');
const totalSlides = slides.length;

function changeSlide(direction) {
    if (totalSlides === 0) return;
    
    const thumbnails = document.querySelectorAll('.thumbnail-item');
    
    // Remove active class from current slide
    slides[currentSlideIndex].classList.remove('active');
    if (thumbnails[currentSlideIndex]) {
        thumbnails[currentSlideIndex].classList.remove('active');
    }
    
    // Calculate new index
    currentSlideIndex = (currentSlideIndex + direction + totalSlides) % totalSlides;
    
    // Add active class to new slide
    slides[currentSlideIndex].classList.add('active');
    if (thumbnails[currentSlideIndex]) {
        thumbnails[currentSlideIndex].classList.add('active');
    }
    
    // Update counter
    updateCounter();
    
    // Scroll thumbnail into view
    if (thumbnails[currentSlideIndex]) {
        thumbnails[currentSlideIndex].scrollIntoView({
            behavior: 'smooth',
            block: 'nearest',
            inline: 'center'
        });
    }
}

function goToSlide(index) {
    if (totalSlides === 0) return;
    
    const thumbnails = document.querySelectorAll('.thumbnail-item');
    
    // Remove active class from current slide
    slides[currentSlideIndex].classList.remove('active');
    if (thumbnails[currentSlideIndex]) {
        thumbnails[currentSlideIndex].classList.remove('active');
    }
    
    // Set new index
    currentSlideIndex = index;
    
    // Add active class to new slide
    slides[currentSlideIndex].classList.add('active');
    if (thumbnails[currentSlideIndex]) {
        thumbnails[currentSlideIndex].classList.add('active');
    }
    
    // Update counter
    updateCounter();
}

function updateCounter() {
    const currentSlideEl = document.getElementById('currentSlide');
    if (currentSlideEl) {
        currentSlideEl.textContent = currentSlideIndex + 1;
    }
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('imageModal');
    // Only handle carousel navigation if modal is not open
    if (!modal || !modal.classList.contains('show')) {
        if (e.key === 'ArrowLeft') {
            changeSlide(-1);
        } else if (e.key === 'ArrowRight') {
            changeSlide(1);
        }
    }
});

// Touch swipe support
let touchStartX = 0;
let touchEndX = 0;

const carouselContainer = document.querySelector('.carousel-main-container');
if (carouselContainer) {
    carouselContainer.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    });

    carouselContainer.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });
}

function handleSwipe() {
    const swipeThreshold = 50;
    const diff = touchStartX - touchEndX;
    
    if (Math.abs(diff) > swipeThreshold) {
        if (diff > 0) {
            // Swipe left
            changeSlide(1);
        } else {
            // Swipe right
            changeSlide(-1);
        }
    }
}
</script>

<!-- Image Modal - Full Screen Gallery (Compatible with laporan_fotos) -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content modal-gallery-fullscreen">
            <!-- Close Button -->
            <button type="button" class="btn-close-gallery" data-bs-dismiss="modal">
                <svg width="32" height="32" fill="currentColor">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                </svg>
            </button>

            <!-- Navigation Buttons for Multiple Images -->
            <button type="button" class="btn-modal-prev" onclick="modalChangeSlide(-1)" id="modalPrevBtn" style="display: none;">
                <svg width="32" height="32" fill="currentColor">
                    <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                </svg>
            </button>

            <button type="button" class="btn-modal-next" onclick="modalChangeSlide(1)" id="modalNextBtn" style="display: none;">
                <svg width="32" height="32" fill="currentColor">
                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                </svg>
            </button>

            <!-- Image Counter -->
            <div class="modal-counter" id="modalCounter" style="display: none;">
                <span id="modalCurrentSlide">1</span> / <span id="modalTotalSlides">1</span>
            </div>

            <!-- Image Container -->
            <div class="modal-image-container">
                <img id="modalImage" src="" class="modal-image-display" alt="Full Size Image">
            </div>

            <!-- Download Button -->
            <a href="#" id="downloadImageBtn" class="btn-download-image" download>
                <svg width="24" height="24" fill="currentColor">
                    <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
                </svg>
                Download
            </a>

            <!-- Image Info -->
            <div class="modal-image-info" id="modalImageInfo">
                <span id="modalImageName">Foto 1</span>
            </div>
        </div>
    </div>
</div>

<style>
/* =====================================
   FULL SCREEN GALLERY MODAL
   ===================================== */

.modal-gallery-fullscreen {
    background: rgba(0, 0, 0, 0.98);
    backdrop-filter: blur(10px);
    border: none;
    border-radius: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.btn-close-gallery {
    position: fixed;
    top: 2rem;
    right: 2rem;
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    z-index: 1060;
}

.btn-close-gallery:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.4);
    transform: rotate(90deg) scale(1.1);
}

/* Modal Navigation */
.btn-modal-prev,
.btn-modal-next {
    position: fixed;
    top: 50%;
    transform: translateY(-50%);
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    z-index: 1060;
}

.btn-modal-prev:hover,
.btn-modal-next:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.4);
    transform: translateY(-50%) scale(1.1);
}

.btn-modal-prev {
    left: 2rem;
}

.btn-modal-next {
    right: 2rem;
}

/* Modal Counter */
.modal-counter {
    position: fixed;
    top: 2rem;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(10px);
    color: white;
    padding: 1rem 1.75rem;
    border-radius: 30px;
    font-size: 1.125rem;
    font-weight: 700;
    z-index: 1060;
    border: 2px solid rgba(255, 255, 255, 0.1);
}

#modalCurrentSlide {
    color: #0d6efd;
    font-size: 1.375rem;
}

/* Image Container */
.modal-image-container {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 6rem 4rem 4rem;
}

.modal-image-display {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    border-radius: 12px;
    box-shadow: 0 20px 80px rgba(0, 0, 0, 0.5);
    transition: transform 0.3s ease;
}

.modal-image-display:hover {
    transform: scale(1.02);
}

/* Download Button */
.btn-download-image {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    display: flex;
    align-items: center;
    gap: 0.625rem;
    padding: 1rem 1.75rem;
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    color: white;
    border: none;
    border-radius: 30px;
    font-weight: 700;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.3s ease;
    z-index: 1060;
    box-shadow: 0 8px 24px rgba(13, 110, 253, 0.4);
}

.btn-download-image:hover {
    background: linear-gradient(135deg, #0a58ca 0%, #084298 100%);
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(13, 110, 253, 0.5);
    color: white;
}

/* Image Info */
.modal-image-info {
    position: fixed;
    bottom: 2rem;
    left: 2rem;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(10px);
    color: white;
    padding: 1rem 1.75rem;
    border-radius: 30px;
    font-size: 1rem;
    font-weight: 600;
    z-index: 1060;
    border: 2px solid rgba(255, 255, 255, 0.1);
}

/* Responsive */
@media (max-width: 768px) {
    .btn-close-gallery {
        top: 1rem;
        right: 1rem;
        width: 52px;
        height: 52px;
    }

    .btn-modal-prev,
    .btn-modal-next {
        width: 52px;
        height: 52px;
    }

    .btn-modal-prev {
        left: 1rem;
    }

    .btn-modal-next {
        right: 1rem;
    }

    .modal-counter {
        top: 1rem;
        padding: 0.75rem 1.25rem;
        font-size: 1rem;
    }

    #modalCurrentSlide {
        font-size: 1.125rem;
    }

    .modal-image-container {
        padding: 5rem 2rem 2rem;
    }

    .btn-download-image {
        bottom: 1rem;
        right: 1rem;
        padding: 0.875rem 1.5rem;
        font-size: 0.875rem;
    }

    .modal-image-info {
        bottom: 1rem;
        left: 1rem;
        padding: 0.75rem 1.25rem;
        font-size: 0.875rem;
    }
}

@media (max-width: 576px) {
    .btn-close-gallery,
    .btn-modal-prev,
    .btn-modal-next {
        width: 44px;
        height: 44px;
    }

    .modal-image-container {
        padding: 4.5rem 1rem 1rem;
    }

    .btn-download-image {
        padding: 0.75rem 1.25rem;
        font-size: 0.8rem;
    }

    .modal-counter {
        padding: 0.625rem 1rem;
        font-size: 0.9rem;
    }
}
</style>

<script>
// Store all images for modal navigation
let modalImages = [];
let modalCurrentIndex = 0;

// Open image modal with support for multiple images
function openImageModal(src, index = 0) {
    // Get all photos
    const photos = [];
    
    // Check if we have carousel with multiple photos
    const carousel = document.querySelector('.carousel-main-image');
    if (carousel) {
        // Multiple photos mode - get from carousel slides
        const slideImages = document.querySelectorAll('.carousel-slide img.carousel-image');
        slideImages.forEach(img => {
            photos.push(img.src);
        });
    } else {
        // Single photo mode or fallback
        const singleImage = document.querySelector('.report-image-modern');
        if (singleImage) {
            photos.push(singleImage.src);
        } else {
            photos.push(src);
        }
    }
    
    modalImages = photos;
    modalCurrentIndex = index;
    
    // Update modal
    updateModalImage();
    
    // Show/hide navigation buttons based on photo count
    const prevBtn = document.getElementById('modalPrevBtn');
    const nextBtn = document.getElementById('modalNextBtn');
    const counter = document.getElementById('modalCounter');
    
    if (photos.length > 1) {
        prevBtn.style.display = 'flex';
        nextBtn.style.display = 'flex';
        counter.style.display = 'block';
        
        // Update total count
        document.getElementById('modalTotalSlides').textContent = photos.length;
    } else {
        prevBtn.style.display = 'none';
        nextBtn.style.display = 'none';
        counter.style.display = 'none';
    }
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
}

// Change slide in modal
function modalChangeSlide(direction) {
    modalCurrentIndex = (modalCurrentIndex + direction + modalImages.length) % modalImages.length;
    updateModalImage();
}

// Update modal image display
function updateModalImage() {
    const modalImage = document.getElementById('modalImage');
    const downloadBtn = document.getElementById('downloadImageBtn');
    const currentSlideEl = document.getElementById('modalCurrentSlide');
    const imageInfo = document.getElementById('modalImageName');
    
    // Update image
    if (modalImage && modalImages[modalCurrentIndex]) {
        modalImage.src = modalImages[modalCurrentIndex];
        
        // Update download button
        if (downloadBtn) {
            downloadBtn.href = modalImages[modalCurrentIndex];
            downloadBtn.download = `foto-${modalCurrentIndex + 1}.jpg`;
        }
        
        // Update counter
        if (currentSlideEl) {
            currentSlideEl.textContent = modalCurrentIndex + 1;
        }
        
        // Update image info
        if (imageInfo) {
            imageInfo.textContent = `Foto ${modalCurrentIndex + 1}`;
        }
    }
}

// Keyboard navigation in modal
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('imageModal');
    if (modal && modal.classList.contains('show')) {
        if (e.key === 'ArrowLeft') {
            modalChangeSlide(-1);
        } else if (e.key === 'ArrowRight') {
            modalChangeSlide(1);
        } else if (e.key === 'Escape') {
            const modalInstance = bootstrap.Modal.getInstance(modal);
            if (modalInstance) {
                modalInstance.hide();
            }
        }
    }
});

// Touch swipe in modal
let modalTouchStartX = 0;
let modalTouchEndX = 0;

const imageModalEl = document.getElementById('imageModal');
if (imageModalEl) {
    imageModalEl.addEventListener('touchstart', function(e) {
        modalTouchStartX = e.changedTouches[0].screenX;
    });

    imageModalEl.addEventListener('touchend', function(e) {
        modalTouchEndX = e.changedTouches[0].screenX;
        handleModalSwipe();
    });
}

function handleModalSwipe() {
    const swipeThreshold = 50;
    const diff = modalTouchStartX - modalTouchEndX;
    
    if (Math.abs(diff) > swipeThreshold) {
        if (diff > 0) {
            // Swipe left
            modalChangeSlide(1);
        } else {
            // Swipe right
            modalChangeSlide(-1);
        }
    }
}
</script>