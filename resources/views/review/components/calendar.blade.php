@php
    use Carbon\Carbon;

    $now = Carbon::now();
    $currentMonth = $now->month;
    $currentYear = $now->year;
    $today = $now->format('Y-m-d');

    // Get first day of month and total days
    $firstDayOfMonth = Carbon::create($currentYear, $currentMonth, 1);
    $daysInMonth = $firstDayOfMonth->daysInMonth;
    $startDayOfWeek = $firstDayOfMonth->dayOfWeek; // 0 = Sunday, 6 = Saturday

    // Convert to Monday-based (0 = Monday)
    $startDayOfWeek = ($startDayOfWeek == 0) ? 6 : $startDayOfWeek - 3;

    // Extract dates that have notes from current month only
    $noteDates = [];
    if(isset($allNotes) && $allNotes) {
        $allNoteDates = $allNotes->keys()->toArray();

        // Filter to only include notes from current month and year
        $noteDates = array_filter($allNoteDates, function($date) use ($currentYear, $currentMonth) {
            $dateObj = Carbon::parse($date);
            return $dateObj->year == $currentYear && $dateObj->month == $currentMonth;
        });
    }

    // Determine if streak should be shown
    
    $showStreak = isset($streak) && $streak >= 3;

    // Month names in Indonesian
    $monthNames = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
@endphp

<div class="calendar-component">
    {{-- Streak Display - Only show if streak >= 3 --}}
    @if($showStreak)
    <div class="streak-display text-center mb-2">
        <span class="streak-icon">🔥</span>
        <span class="streak-count">{{ $streak }}</span>
        <span class="streak-label">Hari Streak!!</span>
    </div>
    @endif

    {{-- Calendar --}}
    <div class="calendar-card">
        <div class="calendar-header d-flex justify-content-between align-items-center mb-2">
            <span class="calendar-month">{{ $monthNames[$currentMonth] }}</span>
            <span class="calendar-year">{{ $currentYear }}</span>
        </div>

        {{-- Calendar Days Header --}}
        <div class="calendar-days-header">
            @foreach(['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'] as $day)
            <div class="day-name">{{ $day }}</div>
            @endforeach
        </div>

        {{-- Calendar Grid --}}
        <div class="calendar-grid">
            {{-- Empty cells before first day --}}
            @for($i = 0; $i < $startDayOfWeek; $i++)
                <div class="calendar-day empty"></div>
            @endfor

            {{-- Days of the month --}}
            @for($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $dateStr = sprintf('%04d-%02d-%02d', $currentYear, $currentMonth, $day);
                    $isToday = $dateStr === $today;
                    $hasNote = in_array($dateStr, $noteDates);

                    $classes = 'calendar-day';
                    if($isToday) $classes .= ' is-today';
                    if($hasNote) $classes .= ' has-note';
                @endphp
                <div class="{{ $classes }}">{{ $day }}</div>
            @endfor
        </div>
    </div>
</div>

<style>
.calendar-component {
    background: #ffffff;
    border-radius: 16px;
    padding: 0.85rem;
    box-shadow: 0 4px 20px rgba(66, 85, 217, 0.08);
    height: 300px;
    display: flex;
    flex-direction: column;
}

.streak-display {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    background: linear-gradient(135deg, #fff5f0 0%, #ffe8dd 100%);
    padding: 0.5rem 0.8rem;
    border-radius: 10px;
    flex-shrink: 0;
}

@keyframes streakPulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

.streak-icon {
    font-size: 1.2rem;
    animation: fireFlicker 1.5s ease-in-out infinite;
}

@keyframes fireFlicker {
    0%, 100% {
        transform: rotate(-5deg);
    }
    50% {
        transform: rotate(5deg);
    }
}

.streak-count {
    font-size: 1.1rem;
    font-weight: 700;
    color: #ff6b35;
}

.streak-label {
    font-size: 1.1rem;
    font-weight: 700;
    color: #2b3674;
}

.calendar-card {
    background: #f8f9ff;
    border-radius: 12px;
    padding: 0.75rem;
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.calendar-header {
    color: #2b3674;
    flex-shrink: 0;
}

.calendar-month {
    font-weight: 600;
    font-size: 0.95rem;
}

.calendar-year {
    font-weight: 700;
    font-size: 1.1rem;
}

.calendar-days-header {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 2px;
    margin-bottom: 0.3rem;
    flex-shrink: 0;
}

.day-name {
    text-align: center;
    font-size: 0.65rem;
    font-weight: 600;
    color: #9ca3af;
    padding: 0.2rem 0;
}

.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 3px;
    flex: 1;
    align-content: start;
}

.calendar-day {
    aspect-ratio: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    color: #2b3674;
    border-radius: 50%;
    transition: all 0.2s ease;
    background: transparent;
    max-height: 32px;
}

.calendar-day.empty {
    background: transparent;
}

.calendar-day.is-today {
    background: #4255d9;
    color: #ffffff;
    font-weight: 700;
}

.calendar-day.has-note {
    background: #ff6b35;
    color: #ffffff;
    font-weight: 600;
}

.calendar-day.has-note.is-today {
    background: linear-gradient(135deg, #4255d9 50%, #ff6b35 50%);
    color: #ffffff;
}

/* Responsive */
@media (max-width: 991.98px) {
    .calendar-component {
        margin-top: 1rem;
        height: auto;
        min-height: 260px;
    }
}

@media (max-width: 767.98px) {
    .calendar-component {
        height: auto;
        min-height: 240px;
    }

    .streak-count,
    .streak-label {
        font-size: 1rem;
    }

    .calendar-day {
        font-size: 0.7rem;
        max-height: 28px;
    }

    .streak-icon {
        font-size: 1.1rem;
    }

    .month-selector,
    .year-selector {
        font-size: 0.75rem;
    }
}
</style>
