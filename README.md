
<div class="hsg-featured-snippet">
<h2>Ticketing System</h2>
<p>A ticketing system is a customer service tool that helps companies manage their service and support cases. The system or app creates a "ticket" which documents customer requests and interactions over time, making it easier for customer service reps to resolve complicated issues.&nbsp;</p>
</div>
<p>Ticketing systems help customer service teams better prioritize their assignments, so they can create a more enjoyable customer experience. Here's how a system like this really works:</p>
<h3>How does a ticketing system work?</h3>

<p>A ticketing system works by first creating a document, or "ticket," that records the interactions on a support or service case. The ticket is shared between both the rep and the customer and logs their communication to one continuous thread. If there's any confusion, or if a detail is overlooked, both parties can refer back to the thread at any point to review past information on the case.</p>

<p>Once the ticket is created, reps can then work on the issue on their end. When they have updates or a resolution, they can alert the customer via the ticket. If the customer has any questions in the meantime, they too can use the ticket to communicate with the customer service rep. The ticketing system then alerts the rep that there has been a response logged on the ticket, and the rep can address it immediately.</p>
<p>When the issue has finally been resolved, either the rep or the customer can close the ticket. Tickets can be reopened though if either party has any additional follow-up questions or requests. Instead of having to create a brand-new ticket with a different rep, the customer has access to the same person that they worked with before and can continue where they left off. Some ticketing systems even include built-in <a href="/service/customer-feedback-culture" rel="noopener" target="_blank">customer feedback</a> tools like <a href="/service/what-is-nps" rel="noopener" target="_blank">NPS</a>® which can collect <a href="/service/get-customer-reviews" rel="noopener" target="_blank">customer reviews</a> every time a ticket is closed.</p>

## Installation

**1.** Clone the repo and cd into it

**2.** _composer install_

**3.** Rename or _copy .env.example file to .env_

**4.** Set database your localhost

**5.** Rename database name, user, password in _.env_ file

**6.** _php artisan key:generate_

**7.** Set your database credentials in your _.env_ file

**8.** In command line type-> _php artisan migrate_

**9.** Then->  _php artisan db:seed --class UsersTableSeeder_

**10.** After-> _php artisan serve_
