# Claims Mitra job workflow

This is how a job moves through the product. Stages are **W-01 … W-12**. Seats and money follow [DOMAIN_RULES.md](DOMAIN_RULES.md). Changing a stage means amending this file and the decision log.

Code source of truth for stage numbers and seats: `application/config/workflow.php`.

---

## Parties on the job (before any stage)

| Seat | Who | Rule |
|---|---|---|
| Assigner | Person at an **Insurer CIN** or **Broker CIN** office | R-05, R-06 |
| Policy office / appointing office / pay office | Three assigner offices (may be different CINs) | R-07 |
| Prime assignee | **Surveyor CIN** (individual or corporate), identified by name + SLA | R-03, R-08 |
| Survey branch | GST office of that Surveyor CIN | R-02 |
| Handler | File owner inside the Surveyor CIN | R-16 |
| Named SLA | Signs if the product is a licensed survey | R-12 |
| Field / inspector | Internal employee or external subcontractor | R-08 |
| Accounts | Billing, TI, dispatch, receipts | R-17 |

---

## Happy path

```
W-01 Appoint  →  W-02 Land on desk  →  W-03 Handler owns file
      →  W-04 Field work (Under Survey)
      →  W-05 ILA + photos/video
      →  W-06 LOR (if needed)
      →  W-07 FSR / report
      →  W-08 Bill (pay office)
      →  W-09 Tax invoice (TI)
      →  W-10 Dispatch report
      →  W-11 Payment (partial → complete)
      →  W-12 Closed
```

Cancel may happen from W-03 onward → status **Cancelled (11)**. Appointment transfer (R-07) may happen at W-01/W-02 without cancelling.

---

### W-01 — Appoint

**Who:** Insurer CIN or Broker CIN person.  
**What:** Create or send a job to a **Surveyor CIN** (individual or corporate). Record product + LOB, loss location, policy / appoint / pay offices, assigner person.  
**Job status:** not yet on the surveyor’s incoming book, or incoming with no handler (`uid_to` empty).  
**Rules:** R-05, R-07, R-20, R-21.

**Why:** The marketplace starts with an assignor. Without the three offices, the later bill hits the wrong GSTIN.

---

### W-02 — Land on a survey desk

**Who:** Surveyor admin or LOB supervisor at the appointed **branch + LOB**.  
**What:** Job sits on that desk. Unassigned files (`uid_to = 0`) are the **supervisor book**, not every handler’s inbox.  
**Rules:** R-14, R-15, R-18.

**Why:** “Keep control under their own head.” If every company user sees every file, there is no desk.

---

### W-03 — Handler owns the file

**Who:** Supervisor/admin gives the job to a handler (including themselves). `uid_to` = handler.  
**What:** One handler. They may send field work internal or external; that does not change prime assignee or AR.  
**Visibility:** Handler sees **own** jobs only. Supervisor/admin sees **all** jobs on mapped LOB/branch, including unassigned.  
**Rules:** R-08, R-16, R-17.

**Why:** Dual owners stall TAT and reports.

---

### W-04 — Field work (status **1 Under Survey**)

**Who:** Handler + inspectors.  
**What:** Visit, collect photos/video/data. Licensed survey still needs a covering SLA to sign later (R-12).  
**Code status:** `1`.

---

### W-05 — ILA + media (status **2**)

Interim loss advice and evidence on the file. Handler assimilates.  
**Code status:** `2`.

---

### W-06 — LOR (status **3**)

Letter of requirement when documents are still needed. Optional by product.  
**Code status:** `3`.

---

### W-07 — FSR / report (status **4**)

Final survey/investigation report in the template. Handler owns writing; named SLA signs if required.  
**Code status:** `4`.  
**Rules:** R-12, R-16.

---

### W-08 — Bill (status **5 Billing**)

Accounts (or admin) raises **one bill per job** against the **pay office** (or cash party). Ship-to = appointing office. Vendor code of this Surveyor CIN at the paying Insurer CIN must persist and print.  
**Code status:** `5`.  
**Rules:** R-22, R-23, R-24, R-25, R-26.

Report delivery may wait for payment **or** proceed on credit — that is a pay-office commercial choice, not a fourth CIN.

---

### W-09 — Tax invoice issued (status **6** then **7**)

TI number and date make the bill issued. Job moves to waiting for TI (**6**) then pending dispatch (**7**).  
**Code status:** `6` Waiting for TI, `7` Pending for dispatch.  
**Who sees this book:** Accounts and admin (R-17).

---

### W-10 — Dispatch (status **8**)

Physical/email dispatch of report (and invoice). Tracking on `claims_dispatch`.  
**Code status:** `8`.

---

### W-11 — Payment (status **9** / **10**)

Receipts hang off the bill; they must not overwrite history. Partial → **9**. Full (after TDS if any) → **10** complete.  
**Code status:** `9` Partial pay, `10` Complete.  
**Rules:** R-27.

---

### W-12 — Closed or cancelled

**10** = complete. **11** = cancelled (reason required). AR and appointment history remain.

---

## Access by seat (W-03 / R-17)

| Connect `usertype` | Seat name | Incoming / dashboard jobs |
|---|---|---|
| **2** | Surveyor admin (and acting supervisor for the selected LOB) | All jobs for that Surveyor CIN + selected LOB, including unassigned |
| **3** | Handler | Only `uid_to` = self |
| **4** | Accounts | Billing onward (statuses 5–10): TI, dispatch, receipts |
| **1** | Individual (one-person practice / own files) | Only `uid_to` = self |

Overlapping hats (R-15): the header company + LOB + role is the **seat you are working as**. Switch role to see the other book.

Until a distinct “supervisor” usertype exists, **usertype 2** is the supervisor book for the selected LOB. That is an implementation stand-in, not a new rule.

---

## What this workflow does not do yet

- Distinct supervisor usertype vs admin (R-15 full tree).
- Survey branch (GST) in the session switcher (still company + department).
- Native foreign-currency invoices (R-26); USD/NPR remain a later change.
- Formal appointment-transfer log (R-07 history).

---

## Decision log

| Date | Decision | Effect |
|---|---|---|
| 2026-08-18 | Adopt W-01–W-12 and seat visibility above. Incoming lists follow handler vs admin vs accounts. | `workflow.php` + incoming/dashboard filters. Vendor code persisted on bill save (R-23). |
