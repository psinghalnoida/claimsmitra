# Claims Mitra domain rules

These rules are binding for product and engineering unless a later decision **amends this file**. Cite a rule by number (for example **R-12**). Do not invent a conflicting model in code or conversation.

**How to change a rule:** add a row to the [Decision log](#decision-log) and edit the rule text in place. Do not leave two live versions of the same number.

---

## A. Vendor organisations (CINs)

### R-01 — Three vendor CIN types only

**Name:** Insurer CIN, Broker CIN, Surveyor CIN.

A **vendor** in this product is one of:

1. **Insurer CIN** — insurance company.
2. **Broker CIN** — insurance broker.
3. **Surveyor CIN** — licensed survey practice (individual or corporate).

**Why:** One flat “company” list mixed insurers, brokers, surveyors, insureds, and others. Jobs, mapping, vendor codes, and bills need three distinct legal parties.

**Not a vendor CIN:** cash insured, investigator-only person (unless they operate as a Surveyor CIN), TPA, agent, workshop — unless a later decision promotes them.

### R-02 — Same spine on every CIN: HO, branches, people

Every CIN has a head office, **branches** (address + GST), and **people mapped onto a subset of those offices**.

**Why:** Insurers, brokers, and survey firms all work as HO + GST offices + staff. Reusing one spine avoids three different org engines.

### R-03 — Identify a Surveyor CIN by name and SLA

- Corporate firm: **firm name + corporate SLA** (IRDAI issues a **separate** SLA to the firm).
- One-person practice: **person name + individual SLA**.

Company Act CIN number is KYC for incorporated firms, not the lookup key.

**Why:** Two firms can have similar names; SLA is the regulator’s unique handle. Individual and corporate SLA numbers must never be treated as the same namespace.

### R-04 — Identify Insurer / Broker CIN by name (and their own licence / Company Act CIN as KYC)

They do **not** carry an SLA. SLA belongs only to surveyors.

**Why:** Prevents stuffing IRDAI survey licences onto insurers or brokers.

---

## B. Who assigns to whom

### R-05 — Insurers and brokers assign to surveyors

**Direction of appointment:** Insurer CIN or Broker CIN → Surveyor CIN.

The Surveyor CIN may be **individual** or **corporate**. Both are Surveyor CINs.

**Why:** The public marketplace is assignors sending work to a pool of surveyors. Surveyors do not appoint insurers.

### R-06 — People assign; offices owe

A **person** at an insurer or broker office raises or handles the appointment. **Accounts receivable** sit on the **pay office** (GST branch), not on that person.

**Why:** Staff transfer, leave, or resignation must not move who is billed. Attribution (who appointed) is a person snapshot; debt is an office.

### R-07 — Three assigner seats on one job (not three companies)

On every job record:

1. **Policy / underwriter office** — whose policy it is.
2. **Claim / appointing office** — who appointed (may transfer; keep history so the previous office can still query).
3. **Pay office** — who is billed (debtor GST).

Plus **loss location** and **assigner person** (snapshot).

**Why:** Live work already splits these (e.g. appoint broker Delhi, pay New India Faridabad). Collapsing them into one “insurer” field breaks bills and queries.

### R-08 — Prime assignee is the appointed Surveyor CIN

The insurer/broker appoints a Surveyor CIN (usually a **branch** + **handler**). That CIN is the **prime assignee**.

A handler may then give work to:

- internal employees of the same Surveyor CIN, or
- **external** surveyors (another Surveyor CIN / individual SLA) or investigators.

External allocation is **subcontract**, not a new insurer appointment, unless the appointment is **formally transferred**.

**Why:** The insurer’s vendor master and bill are against the appointed surveyor, not against every field worker. Subcontracting must not silently change AR.

---

## C. Surveyors, investigators, licences

### R-09 — Surveyor vs investigator

- **Surveyor:** IRDAI-licensed SLA. Licence grants one or more **LOBs**: Motor, Marine Cargo, Marine Hull, Fire, Engineering, Miscellaneous, Crop, LOP.
- **Investigator:** not an SLA. May do investigation / spot / recovery / opinion work that does not require that licence.
- **Every surveyor is an investigator; the reverse is not true.** Both kinds of people exist in the system.

**Why:** Licensed survey and investigation are different legal acts. The job catalogue must not treat them as one profession.

### R-10 — IISLA grade is on the person

Licentiate, Associate, or Fellow (IISLA / IIISLA membership) is an attribute of the **individual**, not of the Surveyor CIN.

**Why:** Grade follows the licence-holder. A firm does not become Fellow because one employee is.

### R-11 — Individual SLA and corporate SLA are both stored and never swapped

A person employed by a Surveyor CIN **keeps** their individual SLA. The firm **keeps** its corporate SLA. Employment does not erase a personal licence.

**Why:** Sign-off and IRDAI compliance attach to the named SLA, not to the employment contract alone.

### R-12 — Licensed survey needs a covering SLA

If the job product is a **licensed survey** in an LOB, a named SLA whose licence covers that LOB must be able to sign. Investigator-only people cannot close that job as surveyors. Supervisor title does not replace a licence.

**Why:** Control of a desk and authority to sign a survey are different. A Fire supervisor who is not licensed in Fire may run the book and still must not sign a Fire survey.

### R-13 — IRDAI LOB vs firm LOB desk

**Licence LOB** (R-09) decides who may **sign**. **Firm LOB / department** (Motor desk, Fire & Engineering supervisor, etc.) decides who **sees and controls** the file.

They must not be collapsed into one field.

**Why:** Ops grouping (including Investigation, Accounts) is not the same list as IRDAI SLA departments. Mixing them either blocks investigators or lets unlicensed people look licensed.

---

## D. Surveyor firm organisation and access

### R-14 — Surveyor admin owns the org chart

The surveyor **admin** (company admin) creates **branches** and **LOBs** on their Surveyor CIN and maps people onto them. Overlapping mappings are allowed.

**Why:** Each firm’s desks differ (Marine only vs Fire+Engineering). The platform cannot hard-code one hierarchy for all Surveyor CINs.

### R-15 — Control line: branch head → LOB supervisor → handler → field

Default line inside a Surveyor CIN:

**CIN → branch → branch head → LOB supervisor(s) → handlers → inspectors / report / admin.**

A person may wear several of these hats at once (including **supervisor and handler**).

**Why:** Firms keep assignment books “under their own head.” Without a control line, every company user sees every file or nobody can supervise.

### R-16 — Handler owns the file

One job, **one handler** at a time. The handler dispatches inspectors, assimilates photos/video/data, and owns report writing.

**Why:** Dual file owners produce duplicate reports, missed TAT, and disputed sign-off.

### R-17 — Visibility follows seats (access rules)

| Seat | Sees |
|---|---|
| **Handler** | **Own** assignments only. |
| **LOB supervisor / branch head** | **All** assignments in the LOBs and branches they are mapped to. |
| **Accounts** | Billing, tax invoice, dispatch, incoming payments, and other admin/accounts functions — not a handler field queue. |
| **Surveyor admin** | Org setup and mappings; typically the union of operational views they are granted. |

The company / branch / LOB switcher chooses **which mapped seat** the user is working as. Other mappings remain; they are other books.

**Why:** This is the access contract the product already aimed at. Incoming lists filtered only by firm+LOB make every desk user a supervisor and hide true handler scope.

### R-18 — One head per book

For a given **branch + LOB**, handlers report to **one** controlling head (supervisor or branch head) so two supervisors do not both own the same book. Wider span (several LOBs, e.g. Fire and Engineering) is an explicit mapping, not an accident.

**Why:** Split ownership of the same queue is how files stall and TAT is gamed.

### R-19 — Hats move; CIN, branch, and AR do not

Handler, supervisor, or assigner **person** can change. Surveyor CIN, survey branch, pay office, and vendor enrolment stay. History of appointing office and of handler is kept.

**Why:** Same as R-06 on the assignee side. People are not the debtor and not the legal survey entity.

---

## E. Job record

### R-20 — Job carries both assigner and assignee snapshots

Minimum snapshot:

**Assigner:** policy office, appointing office (with transfer history), pay office, assigner person, loss location.

**Assignee:** Surveyor CIN (name + SLA), survey branch, handler, named SLA for sign-off (if licensed survey), field workers (internal and/or external). External parties recorded as subcontractors with their CIN/SLA.

**Why:** Reports, bills, and MIS are reconstructed from the job, not from whoever is logged in later.

### R-21 — Job product and LOB are both stored

**Product** examples: Motor Spot, Fire Final, Death investigation. **LOB** is the IRDAI/ops class used for licence and supervisor routing.

**Why:** “Cattle spot” is a product; Miscellaneous/Crop is the licence/desk. One string cannot drive templates, SLA, and supervisor books.

### R-29 — REG and STY; both require media

Every assignment is **REG** (regular) or **STY** (stereotype).

- **Both** require photos and videos on the file.
- **REG:** **ILA and LOR are mandatory.** The handler cannot skip them. This is how regular TAT is kept.
- **STY:** a **repeat** (same insurer / insured / policy / place). ILA and LOR are **optional or mandatory according to the field template**. The handler may also **mark that after the assignment is received** if the template is silent or this file differs.
- The **report** is the meeting point. The system must receive it **along with** the media.

**Why:** REG files need a document chase on a clock. STY repeats must not be forced through ILA/LOR when the product does not use them — otherwise TAT is lost on copy-forward work.

### R-34 — Field templates copy repeating survey data

A **field template** is a named snapshot of the survey form: insurer/broker offices, insured, policy, place of survey, nature of job, **Send ILA / Send LOR**, and **submission TAT** (5 / 15 / 30 days).

- Templates belong to the **handler** and a **nature of job**.
- Applying a template copies those decisions onto the job. After receipt the handler may still change ILA/LOR/TAT for this file.
- Distinct from **email body templates** (`claims_email`), which do **not** control ILA, LOR, or TAT.

**Why:** The template is the product recipe for that repeat, including whether the chase and how many days to dispatch.

### R-36 — TAT runs from acknowledgement to dispatch

The job clock **starts when the acknowledgement is sent** (W-03a) and **ends at dispatch** (W-10).

| Clock | When it applies | Default TAT |
|---|---|---|
| **LOR** | REG always; STY if template/job says send LOR | **24 hours** from acknowledgement |
| **ILA** | REG always; STY if template/job says send ILA | **3 days** from acknowledgement |
| **Submission** (report through dispatch) | Every job | **5, 15, or 30 days** from acknowledgement — set on the **template** or **marked after receipt** |

Missing an ack date means the clocks have not started. LOR reminders (R-33) sit inside the 24-hour LOR TAT; they do not replace it.

**Why:** Insurer letters quote these windows. Starting the clock at data entry (before ack) punishes the desk for mail delay; ending at report (before dispatch) pretends the file has left when it has not.

### R-35 — Acknowledge the assignment before field work

After the case is **entered** and a handler owns it, the handler sends an **acknowledgement** to the appointing thread: nature of assignment, mail subject, To/Cc (from the appointment mail), and a prepared email they **check and send**. At this same step they may **select a field template** (R-34).

This is not ILA and not LOR. It only confirms “we have the appointment.”

**Why:** Insurer desks expect a same-day ack on their subject line. Mixing ack with ILA/LOR delays the receipt confirmation.

### R-33 — LOR chase is review-then-send

On **REG**, and on jobs whose **field template says send LOR**, LOR is a living document checklist, not a one-shot letter. If the field template says skip LOR, this stage is not on the path.

- Paste the **appointment mail** (subject + people). The system **parses and stores** addresses and the original subject.
- Each stored person is marked **To / Cc / Bcc** (or skip this send).
- Each required document is **received** or **pending**. The letter and mailer include **pending items only**.
- Outbound subject is the **appointment subject + our ref** (`case_reference`, else `aid`).
- Choose a **reminder frequency** (days). When due, the job appears on the **dashboard**. The handler reviews inbound mail, ticks received docs, then sends LOR for what is still pending.
- The system **does not silently auto-email**. Frequency is a dashboard nag, not an unattended mailbox.

**Why:** Auto-chasing without checking receipts nags for papers already in. Insurer desks find the file by the appointment thread subject, not a new Claims Mitra title.

---

## F. Billing and money

### R-22 — One bill per job against the pay party

A bill is one commercial document per job (`aid`). **Bill to** = pay office or cash party (debtor). **Ship to / report submitted to** = appointing party. They may differ.

**Why:** The appointing broker is often not the debtor. Billing the ship-to party collects from the wrong GSTIN.

### R-23 — Vendor code binds Surveyor CIN to Insurer CIN

The code printed on the bill is the **insurer’s supplier number for this Surveyor CIN** (this surveyor GSTIN + bank as enrolled). Different surveyors at the same insurer CIN have different codes. The code must **persist and print**.

**Why:** Insurer accounts payable will not pass a bill without their vendor master key. Code without GST/bank, or GST chosen freely on the invoice, breaks enrolment.

### R-24 — Bill in the firm’s (or individual’s) name, not the inspector’s

Prime AR is the appointed Surveyor CIN. Internal staff are not vendors to the insurer. External subcontractors bill the Surveyor CIN unless the insurer re-appoints them.

**Why:** Follows R-08. Prevents the field worker’s GST appearing as the supplier of record.

### R-25 — Cash / spot party is not a CIN

Spot and cash jobs may bill the **insured/individual**. GST may be NA. The insurer may reimburse the insured only if the claim is paid. Surveyor AR stays on the cash party, not on an insurer hub.

**Why:** Treating every cash client as a vendor CIN pollutes insurer/broker masters and GST logic.

### R-26 — Document currency is first-class

Lines and totals belong to the **document currency**.

- **INR tax invoice:** GST as per your GSTIN vs their GSTIN (CGST+SGST vs IGST); skip GST if their GST is NA.
- **Export / foreign (USD, NPR, others):** amounts in that currency; GST off (or proper export wording); not “price in INR, compute GST, strip on PDF, multiply by a typed rate.”

**Why:** Current USD/NPR behaviour is an INR overlay. It misstates tax, words (e.g. “Paisa” on USD), and TI lists that still format INR.

### R-27 — Receipts do not replace the bill

Payments (NEFT, TDS, partial/final) hang off the bill as history. Updating a receipt must **not** wipe prior receipts.

**Why:** Partial pay and TDS are how insurer AR actually closes. Overwrite looks like the case is settled when it is not.

### R-30 — Dispatch after billing must be recorded

After the bill (and TI), the report is **dispatched**. The system must store every dispatch with:

- **Mode:** online portal submission, **email**, **post**, or **physical handover**
- **To whom:** **paying office** and/or **other concerned office** (appointing/policy/other)
- Date, and tracking number when posted

One job may have more than one dispatch (e.g. portal to insurer and post to pay office).

**Why:** Delivery is how the debtor can pass the bill. Unrecorded handovers cannot be proved. Post to pay office vs another office is not the same act.

### R-31 — After dispatch, wait for payment advice

Dispatched jobs **await payment advice**. When advice is received:

- If the bill is **not fully paid** (including TDS as agreed) → **pursue the balance** (status partial).
- If it is **fully paid** (or written off by a later decision) → **archive** the case in the record.

Advice is not the same as the bill (R-27). No advice yet = still waiting, not archived.

**Why:** Accounts work is chase-or-file, not “dispatched = closed.”

### R-32 — Keep file and media at least 3 years

The case file, report, photos, and videos must be **retained for at least three years** after the case is archived (or cancelled). Do not purge earlier for space or “complete” status.

**Why:** Insurer/survey disputes, IRDAI queries, and tax audits outlast the payment cycle.

---

## G. Implementation honesty

### R-28 — Software may lag the rules; the rules win

Existing tables (`claims_company` + profession flags, departments as a mixed LOB list, incoming jobs filtered by firm+department not by handler, vendor code dropped on save, FX as PDF conversion) are **partial**. New work must move toward these rules, not re-encode the lag as policy.

**Why:** Otherwise each feature “matches production” and the domain never converges.

---

## Decision log

| Date | Decision | Effect |
|---|---|---|
| 2026-08-18 | Initial rules captured from product-owner working model (vendor CINs, assignment, survey org, billing). | R-01–R-28 adopted. |
| 2026-08-18 | Job workflow W-01–W-12 adopted; incoming lists follow seats (R-17). | See `docs/WORKFLOW.md`. Vendor code persisted on bill save (R-23). |
| 2026-08-18 | REG vs STY. Media required on both. ILA/LOR only on REG. Report is the join. | R-29. |
| 2026-08-18 | STY may still require ILA/LOR per job. Field templates for repeat insurer/insured/policy/place. Ack email after entry; template selectable then. | R-29 amended. R-34, R-35. |
| 2026-08-18 | ILA/LOR send-or-skip is stored on the field template (not the email template). | R-29, R-34. |
| 2026-08-18 | REG: ILA+LOR always mandatory. STY: template or post-receipt mark. TAT: LOR 24h, ILA 3d, submission 5/15/30d, ack→dispatch. | R-29, R-36. |
| 2026-08-18 | Dispatch modes + destination; await payment advice then chase or archive; retain file/media ≥ 3 years. | R-30–R-32. |
| 2026-08-18 | LOR chase: paste appointment mail, To/Cc/Bcc, mark received, dashboard frequency reminders, subject = appointment + our ref. No silent auto-mail. | R-33. |
