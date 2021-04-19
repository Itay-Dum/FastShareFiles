
import random
import discord
from discord.ext import commands
import os
from shutil import copyfile
import datetime
import pytz
import calendar
from requests import get

global SAVED

SAVED = []
HOURS_OF_LESSONS = ('08:00', '08:51', '09:45', '10:50', '11:41', '12:35', '13:21', '14:15', '15:01', '15:55', '16:41')
FULL_HOURS_OF_LESSONS = (
    ['08:00', '08:40'], ['08:50', '09:30'], ['09:45', '10:30'], ['11:00', '11:40'], ['11:50', '12:30'],
    ['13:00', '13:35'], ['13:45', '14:20'], ['14:25', '15:00'], ['15:10', '15:50'], ['15:50', '16:30']
    , ['16:41', '17:25'])
SUNDAY_LESSONS = ("EK", "EK", "History", "Sport", "Citizenship", "Citizenship", "Math", "Math", "Math", "History", "X")
MONDAY_LESSONS = ("Zyber-Riki", "Zyber-Riki", "Zyber-Riki", "Zyber-Riki", "Bible", "Math", "Math", "Math", "Bible"
                  , "Bible", "Bible")
TUESDAY_LESSONS = ("Physics", "Physics", "Physics", "Zyber-Rachel", "Zyber-Rachel", "Zyber-Rachel", "English"
                   , "English", "EK", "X", "X")
WEDNESDAY_LESSONS = ("Zyber-Rachel", "Zyber-Rachel", "Zyber-Rachel", "Zyber-Rachel", "AU", "EK", "EK", "Bible", "Bible"
                     , "History", "X")
THURSDAY_LESSONS = ("Citizenship", "Citizenship", "Math", "Math", "Sport", "Physics", "Physics", "Physics", "Physics"
                    , "Citizenship", "Citizenship")
FRIDAY_LESSONS = ("History", "History", "History", "English", "English", "X", "X", "X", "X", "X", "X")
ALL_LESSONS = {'Sunday': SUNDAY_LESSONS,
               'Monday': MONDAY_LESSONS,
               'Tuesday': TUESDAY_LESSONS,
               'Wednesday': WEDNESDAY_LESSONS,
               'Thursday': THURSDAY_LESSONS,
               'Friday': FRIDAY_LESSONS
               }
LINKS_FOR_LESSONS = {
    'Sunday': ['' for _ in range(11)],
    'Monday': ['' for _ in range(11)],
    'Tuesday': ['' for _ in range(11)],
    'Wednesday': ['' for _ in range(11)],
    'Thursday': ['' for _ in range(11)],
    'Friday': ['' for _ in range(11)]
}
STUDENTS = '''
ויקטוריה אופימצב

רומי אנציפרוב

ליאורה בורשטין

יובל בללובסקי

אורי יוס בר עוז

הדר גוטספלד

ליאור מר דדון

נועם הר-טוב

אייל כץ

בן אברהם לכנר

עידו פלאח

עמית פרידמן אירופה

ליאור צפיר

טלי קוגן

נועם קירפיץ'

יובל קשת

היאלי שאול

יובל שוחט

טל שחר

טל שנרר

'''.strip().split("\n\n")

STUDENTS_CHOSEN = STUDENTS



TOKEN = "NzY5OTg1MzMxNDE1NDgyMzY4.X5W-uA.JSt-pO8Tuof2qpEZbh4IpLuaHbw"

bot = commands.Bot(command_prefix=".")
global h
global ina_counter
ina_counter = 0

with open('saved.txt', 'r+') as file:
    SAVED = file.read().split('\n')


with open("links.txt", "r+") as file:
    LINKS = file.read().split("\n")

# Sunday Bible link

@bot.event
async def on_ready():
	await bot.change_presence(activity=discord.Activity(type=discord.ActivityType.listening, name="your commands!"))
	print('The bot is up and ready')


@bot.command(aliases=('stikcer', 'sticke', 's'))
@commands.cooldown(1, 2, commands.BucketType.guild)
async def sticker(ctx):
    """Sends a random sticker"""
    global h
    h = random.choice(os.listdir("stickers/"))
    path = "stickers/" + h
    await ctx.send(file=discord.File(path))


@bot.command(aliases=['rm', 'rmlst', 'r'])
@commands.has_any_role('ADMINS', 'Zlotzy')
async def removelast(ctx):
    """Removes the last sticket sent by the bot from the list"""
    global h
    await ctx.send(file=discord.File("stickers/" + h))
    await ctx.send("The sticker above has been removed!")
    os.remove("stickers/" + h)


@bot.command()
@commands.has_any_role('ADMINS')
async def clear(ctx):
    """Clears all the saved sticker"""
    global SAVED
    with open('saved.txt', 'r+') as file:
        arr = file.read().split('\n')
        for value in arr:
            if not value == '':
                os.remove(value)
        file.truncate(0)
        SAVED = file.read().split('\n')
    await ctx.send('All files has been cleared successfully')



@bot.command(aliases=(["rand", "ra"]))
async def random_people(ctx):
    try:
        global STUDENTS_CHOSEN
        random_number = random.SystemRandom().randint(0, len(STUDENTS_CHOSEN) - 1)
        student = STUDENTS[random_number]
        STUDENTS_CHOSEN.remove(student)
        await ctx.send(f"Victim chosen is: {student}, students left: {len(STUDENTS_CHOSEN)}")
    except Exception as e:
        await ctx.send("Every one participated")

@bot.command(aliases=(['sl', 'showl']))
async def showlast(ctx):
    """Shows the last sticker that had been sent"""
    global h
    await ctx.send(file=discord.File("stickers/" + h))


@bot.command()
async def save(ctx, *file):
    """Saves the last sticker had been sent"""
    global h
    global SAVED
    if f"{file[0]}.webp" not in SAVED:
        copyfile(r"stickers/" + h, f"{file[0]}.webp")
        SAVED.append(f"{file[0]}.webp")
        with open('saved.txt', 'a') as f:
            f.write(f"\n{file[0]}.webp")
        h = f"{file[0]}.webp"
        await ctx.send(f"The file was saved successfully! Access it using .show {file[0]}")
    else:
        await ctx.send("File with this name already exists!")


@bot.command()
async def show(ctx, *args):
    """Shows a sticker from the saved stickers list"""
    try:
        await ctx.send(file=discord.File(f"{args[0]}.webp"))
    except:
        await ctx.send(f"Cant find photo {args[0]}")

def get_lesson_index_by_name(name, day):
    for i, x in enumerate(ALL_LESSONS[day]):
        if name.lower() == x.lower():
            return i
    return -1


@bot.command(aliases=(["assign_link"]))
async def al(ctx, *args):
    """Assign zoom link to a lesson; Usage: [lessons_name] [lesson_link] [*lesson_day:default is today]"""
    global LINKS

    my_date = datetime.datetime.now(pytz.timezone('Asia/Jerusalem'))
    day = calendar.day_name[my_date.weekday()]
    usage = "Usage: [lesson_name] [lesson_link] [*lesson_day:default is today]"
    try:
        lesson_name, lessons_link = args[0], args[1]
        try:
            lesson_day = args[2]
        except:
            lesson_day = day
        lesson_index = get_lesson_index_by_name(lesson_name, lesson_day)
        if lesson_index == -1:
            await ctx.send(usage)
            return
        if lesson_day not in ALL_LESSONS.keys():
            await ctx.send(usage)
            return
        
        LINKS_FOR_LESSONS[lesson_day][int(lesson_index)] = f" - [קישור לזום]({lessons_link})"


        embed = discord.Embed(
                    title=f"Added succefully link:{lessons_link} to lesson {lesson_name} on day {lesson_day}",
                    color=discord.Colour.gold()
                )
        embed.set_author(name="Dumay", icon_url="https://i.imgur.com/bpolT51.png",
                     url="https://github.com/Itay-Dum")

        await ctx.send(embed=embed)
    except:
        await ctx.send(usage)

@bot.command(aliases=(["remove_link"]))
async def rl(ctx, *args):
    usage = "Usage: [lesson_name] [*lesson_day:default is today]"
    my_date = datetime.datetime.now(pytz.timezone('Asia/Jerusalem'))
    day = calendar.day_name[my_date.weekday()]
    try:
        lesson_name = args[0]
        try:
            lesson_day = args[1]
        except:
            lesson_day = day
        lesson_index = get_lesson_index_by_name(lesson_name, lesson_day)
        if lesson_index == -1:
            await ctx.send(usage)
        if lesson_day not in ALL_LESSONS.keys():
            await ctx.send(usage)
        
        LINKS_FOR_LESSONS[lesson_day][int(lesson_index)] = ''
        embed = discord.Embed(
                    title=f"Deleted succefully the lesson link",
                    color=discord.Colour.gold()
                )
        embed.set_author(name="Dumay", icon_url="https://i.imgur.com/bpolT51.png",
                     url="https://github.com/Itay-Dum")

        await ctx.send(embed=embed)
    except:
        await ctx.send(usage)

@bot.command()
async def showsaves(ctx):
    """Show the saved stickers"""
    global SAVED
    if not (SAVED[0] == '' and len(SAVED) <= 1):
        print(SAVED)
        temp = "\n".join(SAVED)
        await ctx.send(file=discord.File("saved.txt"))
    else:
        await ctx.send("There is nothing saved yet")


@bot.command()
async def newmathlesson(ctx):
    """Resets the math counter"""
    global ina_counter
    global STUDENTS_CHOSEN
    ina_counter = 0
    STUDENTS_CHOSEN = STUDENTS
    await ctx.send("The כך או אחרת  counter and the victim chosen were reset!")


@bot.command()
async def add(ctx):
    """inc [ina_counter], 1"""
    global ina_counter
    ina_counter += 1
    await ctx.send(f"Current כך או אחרת is: {ina_counter}")



@bot.command()
async def get_ip(ctx):
    if ctx.author.id == 406084372710555649 or ctx.author.id == 293083786839719937:
        ip = get('http://ipgrab.io').text
        await ctx.author.send(f"The ip is:|| {ip}||")
    else:
        await ctx.send("You are not allowed to use this command dont try again")


@bot.command()
async def gs(ctx):
    await ctx.send(file=discord.File("schedule.png"))



@bot.command(aliases=['l', "les"])
async def lesson(ctx):
    try:
        my_date = datetime.datetime.now(pytz.timezone('Asia/Jerusalem'))

        temp = datetime.date.today()

        hour = str(my_date)[11:13]
        minutes = str(my_date)[14:16]
        current_day_list = ALL_LESSONS[calendar.day_name[my_date.weekday()]]
        lesson_hour = max([t for t in HOURS_OF_LESSONS if t < f'{hour}:{minutes}'])
        lesson_now_index = HOURS_OF_LESSONS.index(lesson_hour)

        embed = discord.Embed(
            title=f"{calendar.day_name[temp.weekday()]}s Lessons",
            color=discord.Colour.gold()
        )
        embed.set_author(name="Dumay", icon_url="https://i.imgur.com/bpolT51.png", url="https://github.com/Itay-Dum")
        lessons = ''
        current = ''
        lesson_hour_index = ''
        for lesson_hour_index, lesson in enumerate(current_day_list):
            link = LINKS_FOR_LESSONS[calendar.day_name[my_date.weekday()]][lesson_hour_index]
            if lesson_hour_index == lesson_now_index:
                lessons += f"> **{lesson.upper()}** - ({FULL_HOURS_OF_LESSONS[lesson_hour_index][0]} - {FULL_HOURS_OF_LESSONS[lesson_hour_index][1]})"+ link + '\n'                               
                current = lesson
            elif lesson != "X":
                lessons += f"> {lesson} - ({FULL_HOURS_OF_LESSONS[lesson_hour_index][0]} - {FULL_HOURS_OF_LESSONS[lesson_hour_index][1]})"+ link + '\n'

        embed.add_field(value=lessons, name=f"> Current lesson: {current.upper()}")
        await ctx.send(embed=embed)
    except Exception as e:
        print(e)



@bot.command(aliases=['nl', 'nextl'])
async def next_lesson(ctx):
    """Sends the remaining time until next lesson"""
    my_date = datetime.datetime.now(pytz.timezone('Asia/Jerusalem'))
    hour = str(my_date)[11:13]
    minutes = str(my_date)[14:16]
    lesson_hour = max([t for t in HOURS_OF_LESSONS if t < f'{hour}:{minutes}'])
    lesson_now_index = HOURS_OF_LESSONS.index(lesson_hour)
    next_lesson_in_seconds = int(HOURS_OF_LESSONS[lesson_now_index + 1][:2]) * 3600 + int(
        HOURS_OF_LESSONS[lesson_now_index + 1][3:]) * 60
    hour_now_in_sec = int(hour) * 3600 + int(minutes) * 60

    embed = discord.Embed(
                    title=f"{(next_lesson_in_seconds - hour_now_in_sec) // 60} min untill {ALL_LESSONS[calendar.day_name[my_date.weekday()]][lesson_now_index + 1]}",
                    color=discord.Colour.gold()
                )
    embed.set_author(name="Dumay", icon_url="https://i.imgur.com/bpolT51.png",
                     url="https://github.com/Itay-Dum")

    embed.set_author(name="Dumay", icon_url="https://i.imgur.com/bpolT51.png", url="https://github.com/Itay-Dum")
    await ctx.send(embed=embed)


@bot.command(aliases=["f", "sch", "fs"])
async def schedule(ctx):
    try:
        embed = discord.Embed(
            title='FULL SCHEDULE',
            color=discord.Colour.gold()
        )
        embed.set_author(name="Dumay", icon_url="https://i.imgur.com/bpolT51.png", url="https://github.com/Itay-Dum")


        embed.add_field(
            name=f'**Sunday**',
            # value=f'> Kills: Test2\n> Position Pt: Test3\n> Total Pt: fdfd',
            value="\n".join(["> " + i + str(LINKS_FOR_LESSONS["Sunday"][get_lesson_index_by_name(i, "Sunday")]) for i in SUNDAY_LESSONS if i != "X"]),
            inline=True)

        embed.add_field(
            name=f'**Monday**',
            # value=f'> Kills: Test2\n> Position Pt: Test3\n> Total Pt: fdfd',
            value="\n".join(["> " + i + str(LINKS_FOR_LESSONS["Monday"][get_lesson_index_by_name(i, "Monday")]) for i in MONDAY_LESSONS if i != "X"]),
            inline=True)

        embed.add_field(
            name=f'**Tuesday**',
            # value=f'> Kills: Test2\n> Position Pt: Test3\n> Total Pt: fdfd',
            value="\n".join(["> " + i + str(LINKS_FOR_LESSONS["Tuesday"][get_lesson_index_by_name(i, "Tuesday")]) for i in TUESDAY_LESSONS if i != "X"]),
            inline=True)

        embed.add_field(
            name=f'**Wednesday**',
            # value=f'> Kills: Test2\n> Position Pt: Test3\n> Total Pt: fdfd',
            value="\n".join(["> " + i + str(LINKS_FOR_LESSONS["Wednesday"][get_lesson_index_by_name(i, "Wednesday")]) for i in WEDNESDAY_LESSONS if i != "X"]),
            inline=True)

        embed.add_field(
            name=f'**Thursday**',
            # value=f'> Kills: Test2\n> Position Pt: Test3\n> Total Pt: fdfd',
            value="\n".join(["> " + i + str(LINKS_FOR_LESSONS["Thursday"][get_lesson_index_by_name(i, "Thursday")])for i in THURSDAY_LESSONS if i != "X"]),
            inline=True)

        embed.add_field(
            name=f'**Friday**',
            # value=f'> Kills: Test2\n> Position Pt: Test3\n> Total Pt: fdfd',
            value="\n".join(["> " + i + str(LINKS_FOR_LESSONS["Friday"][get_lesson_index_by_name(i, "Friday")]) for i in FRIDAY_LESSONS if i != "X"]),
            inline=True)

        await ctx.send(embed=embed)
    except Exception as e:
        print(e)


@bot.command()
async def unmute(ctx):
    """Removes server mute on the member that summons the command"""
    await ctx.message.author.edit(mute=False)


@bot.command()
async def undeafen(ctx):
    """Removes server deafen on the member that summons the command"""
    await ctx.message.author.edit(deafen=False)


@bot.command(aliases=['sr'])
async def spam(ctx, f, amount):
    try:
        for i in range(amount if amount <= 5 else 5):
            print(f)
            await ctx.send(file=discord.File(f"{f}.webp"))
    except Exception as e:
        print(e)
        await ctx.send(f"No such file {f}")


@bot.event
async def on_command_error(ctx, error):
    if isinstance(error, commands.CommandNotFound):
        await ctx.send(
            f"There is no such command as {ctx.message.content} please try using .help to see the available commands.")
    elif isinstance(error, commands.CommandOnCooldown):
        await ctx.send(f"Stop the spamming Mr.{ctx.author.mention}, Calm down!")


@bot.command(pass_context=True)
@commands.has_role("Admin")  # This must be exactly the name of the appropriate role
async def test(ctx):
    member = ctx.message.author
    role = get(member.server.roles, name="Test")
    await bot.add_roles(member, role)

@bot.event
async def on_member_join(member):
    role = discord.utils.get(member.server.roles, name='Tomba')
    await bot.add_roles(member, role)


bot.run(TOKEN)
