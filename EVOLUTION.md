# Project Evolution: A Developer's Retrospective

**Author:** Ivan Piskunov
**Date:** October 26, 2023

## Part 1: The Spark (2019)

It started not as a project, but as a question from a student: *"How do you actually protect a website from a brute-force attack?"*

I could point them to plugins like Wordfence, but I wanted to *show* them. I wanted to deconstruct the magic into understandable code. That afternoon, `wp-guardmaster.php` was born. It was messy, procedural, and its logic was brittle—but it worked. It was a perfect, tangible example.

The core concept was beautiful in its simplicity: use WordPress's built-in Transients API as a quick-and-dirty key-value store to count attempts from an IP. This became the foundational lesson for my students on practical, within-the-framework problem-solving.

## Part 2: The Classroom Workhorse (2020)

The 2019 prototype was a hit in lectures. It made abstract security concepts concrete. But using it as a teaching tool exposed its flaws—both in code and as a learning artifact.

The 2020 refactor (`v0.5.0`) was driven by pedagogy. I needed to demonstrate:
1.  **Maintainability:** Hence, the code was split into logical modules. I could now walk students through the `Login_Limiter` class without them getting lost in email logic.
2.  **Configurability:** Hard-coded values are a nightmare. Moving settings to the database was a mandatory step to teach the WordPress Options API.
3.  **Resilience:** We found and fixed the perpetual lockout bug *together* in a lab session. It was a more valuable lesson than any perfectly working code could have provided.

For two years, this beta version was the culmination of my "Secure Development" module. It was no longer just my project; it was our learning tool.

## Part 3: The Hiatus & The Return (2021-2023)

Life, as it does, shifted priorities. My work as an author and lecturer on broader cybersecurity topics took precedence. WP GuardMaster, while effective as a teaching aid, sat dormant. It was "good enough."

But the engineer in me is never satisfied with "good enough." The idea of leaving it as an imperfect example started to itch. In mid-2023, I decided to close the loop. This pet project deserved a proper finale.

This wasn't just about adding features. It was about embodying the best practices I preach:
-   **OOP Architecture:** The rewrite to classes is a love letter to modern, sustainable WordPress development.
-   **Security Hygiene:** Sanitizing every input, escaping every output. The code itself had to be a benchmark of security, not just a tool for it.
-   **Professional Polish:** A settings page, proper internationalization support, a detailed README, and this changelog. These are the hallmarks of a finished product, and I wanted students to see what "finished" looks like.

## Conclusion

WP GuardMaster's journey from a simple answer to a student's question into a comprehensive educational platform mirrors the journey I hope for my own students: start with curiosity, refine through practice, learn from your mistakes, and never stop striving for excellence.

This project is now complete. It stands as a testament to the fact that even "pet projects" can be powerful tools for learning and teaching when approached with passion and rigor.

– Ivan
