<div id="top"></div>

# fluent-keyboard
A fluent keyboard created for MTProto syntax

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li><a href="#installation">Installation</a></li>
    <li>
        <a href="#usage">Usage</a>
        <ol>
            <li><a href="#defining-a-keyboard">Defining a Keyboard</a></li>
            <li><a href="#defining-buttons">Defining Buttons</a></li>
            <li>
                <a href="#bind-buttons-to-a-keyboard">Bind Buttons to a Keyboard</a>
                <ol>
                    <li><a href="#by-row">By Row</a></li>
                    <li><a href="#by-button">By Button</a></li>
                    <li><a href="#as-stack">As Stack</a></li>
                </ol>
            </li>
            <li><a href="#forcereply-and-replykeyboardremove">ForceReply and ReplyKeyboardRemove</a></li>
        </ol>
    </li>
  </ol>
</details>

## Installation

Install the package using composer:

```shell
composer require easy-keyboard/fluent-keyboard
```

<p align="right">(<a href="#top">back to top</a>)</p>

## Usage

If you need to create a keyboard you can use the classes provided by this package as a drop-in replacement.

This is best explained with an example:

```php
$this->messages->sendMessage(
    chat_id:       12345,
    text:          'Keyboard Example',
    reply_markup:  KeyboardMarkup::make()
        ->singleUse()
        ->addButton(KeyboardButton::Text('Cancel'))
        ->addButton(KeyboardButton::Text('OK'))
        ->init()
);
```

A ReplyKeyboardMarkup is created by calling the static `make()` method on `KeyboardMarkup`. After that every field,
like `singleUse`, ... add some extras. Buttons can be added by calling
the `addButton()` method. We have a detailed look on that later.(note that this keyboard need to convert to array to 
readable by your robot so at the end you need to call `init()` method)

<p align="right">(<a href="#top">back to top</a>)</p>

### Defining a Keyboard

You can create a keyboard by calling the static `make()` method on its class.

After that you can chain methods to set additional fields that are available in the Bot API. This is done by calling the
`placeholder()` method.

```php
KeyboardMarkup::make()
    ->placeholder('Placeholder')
    ->init();
```

<p align="right">(<a href="#top">back to top</a>)</p>

### Defining Buttons

The Buttons are created in the different way:

```php
KeyboardButton::Phone('Send my Contact');
```

This is done the same way for `InlineButton`:

```php
InlineButton::Url('hello','https://example.com');
```

<p align="right">(<a href="#top">back to top</a>)</p>

### Bind Buttons to a Keyboard

The keyboard does not work without any buttons, so you need to pass the buttons to the keyboard. There are a few ways to
do this.

#### By Row

```php
KeyboardMarkup::make()
    ->row([
        KeyboardButton::Text('Cancel'),
        KeyboardButton::Text('OK')
    ])
    ->init();
```

If you need more than one row, call `row()` multiple times:

```php
KeyboardInline::make()
    ->row([
        InlineButton::Callback('1','page-1'),
        InlineButton::Callback('2','page-2'),
        InlineButton::Callback('3','page-3')
    ])
    ->row([
        InlineButton::Callback('prev','page-prev'),
        InlineButton::Callback('next','page-next')
    ])
    ->inint();
```

#### By Button

```php
KeyboardMarkup::make()
    ->addButton(KeyboardButton::Text('First Button'))
    ->addButton(KeyboardButton::Text('Second Button'))
    ->inint();
```

If you need more than one row, just call the row method without arguments, and continue calling `addButton()`:

```php
KeyboardInline::make()
    ->addButton(InlineButton::Callback('A','answer-a'))
    ->addButton(InlineButton::Callback('B','answer-b'))
    ->row()
    ->addButton(InlineButton::Callback('C','answer-c'))
    ->addButton(InlineButton::Callback('D','answer-d'))
    ->inint();
```

It's up to you if you define your buttons inline like in these examples or if you'd like to generate a whole row beforehand and
pass the variable to the `row()` method.

#### As Stack

If you want to add a bunch of buttons that have each a row for themselves you can use the `Stack()` method.

```php
KeyboardInline::make()
    ->Stack([
        InlineButton::Login('Login','https://example.com/login'),
        InlineButton::Url('Visit Homepage','https://example.com')
    ])
    ->inint();
```


**You can mix and match the `row()`, `Stack()` and `addButton()` methods as it fits your needs.**

<p align="right">(<a href="#top">back to top</a>)</p>

### KeyboardForceReply and KeyboardHide

KeyboardForceReply and KeyboardHide can be used the same way as a normal keyboard, but they do not receive any buttons:

```php
$this->reply('Thank you',
    reply_markup : KeyboardHide::make()->init()
);
```

```php
$data['reply_markup'] = KeyboardForceReply::make()
    ->addButton(KeyboardButton::Text('Hello please reply'))
    ->placeholder('must reply')
    ->init();
```

<p align="right">(<a href="#top">back to top</a>)</p>

